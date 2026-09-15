<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Services\WavePaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WaveWebhookController extends Controller
{
    public function __construct(protected WavePaymentService $wave) {}

    /**
     * Point d'entree des webhooks Wave (confirmation de paiement).
     * URL a declarer : route('payment.wave.webhook')
     */
    public function handle(Request $request)
    {
        $payload = $request->getContent();
        $signature = $request->header('Wave-Signature', '');

        if (! $this->wave->verifyWebhookSignature($payload, $signature)) {
            Log::warning('Wave webhook: signature invalide.');

            return response()->json(['error' => 'invalid_signature'], 400);
        }

        $data = $request->all();

        /*
         * Payload Wave (event "checkout.completed") :
         * id, event_type, amount, currency, client_reference,
         * transaction_id, checkout_status, payment_status, when_updated...
         */
        $checkoutId = $data['id'] ?? $data['checkout_id'] ?? null;
        $clientReference = $data['client_reference'] ?? null;
        $eventType = $data['event_type'] ?? 'checkout.completed';

        if ($eventType !== 'checkout.completed') {
            return response()->json(['status' => 'ignored']);
        }

        if (! $checkoutId && ! $clientReference) {
            Log::warning('Wave webhook: aucune reference (checkout_id/client_reference).');

            return response()->json(['error' => 'missing_reference'], 422);
        }

        $payment = Payment::query()
            ->where('provider', 'wave')
            ->where(function ($q) use ($checkoutId, $clientReference) {
                if ($checkoutId) {
                    $q->orWhere('checkout_id', $checkoutId);
                }

                if ($clientReference) {
                    $q->orWhere('client_reference', $clientReference);
                }
            })
            ->latest('id')
            ->first();

        if (! $payment) {
            Log::warning('Wave webhook: aucun paiement correspondant.', ['data' => $data]);

            return response()->json(['error' => 'payment_not_found'], 404);
        }

        $hasSucceeded = ($data['payment_status'] ?? null) === 'succeeded'
            || ($data['checkout_status'] ?? null) === 'complete';

        if ($hasSucceeded) {
            $payment->update([
                'status' => Payment::STATUS_PAID,
                'payment_status' => 'succeeded',
                'checkout_status' => 'complete',
                'transaction_id' => $data['transaction_id'] ?? $payment->transaction_id,
                'raw_payload' => $data,
                'paid_at' => now(),
            ]);
        } elseif (($data['checkout_status'] ?? null) === 'expired') {
            $payment->update([
                'status' => Payment::STATUS_EXPIRED,
                'checkout_status' => 'expired',
                'raw_payload' => $data,
            ]);
        } else {
            $payment->update([
                'status' => Payment::STATUS_FAILED,
                'checkout_status' => $data['checkout_status'] ?? 'failed',
                'payment_status' => $data['payment_status'] ?? null,
                'error_message' => ($data['last_payment_error']['message'] ?? null) ?: null,
                'raw_payload' => $data,
            ]);
        }

        return response()->json(['status' => 'ok']);
    }
}