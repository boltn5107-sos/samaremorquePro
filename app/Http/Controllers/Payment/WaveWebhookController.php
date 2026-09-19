<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Services\WavePaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * Entree des webhooks Wave : c'est ici que le paiement est CONFIRME cote serveur.
 *
 * Flux complet d'un paiement (Option B — commission du professionnel) :
 *   1. WaveCheckoutController cree la session et redirige le payeur vers Wave.
 *   2. Le payeur (pro) valide sur SON telephone avec son code PIN.
 *   3. Wave envoie un POST sur la route payment.wave.webhook (evenement checkout.completed).
 *   4. Ce controleur verifie la signature, retrouve la ligne `payments` correspondante
 *      et passe son statut a `paid` (ou failed / expired selon le cas).
 */
class WaveWebhookController extends Controller
{
    public function __construct(protected WavePaymentService $wave) {}

    /**
     * Point d'entree des webhooks Wave (confirmation de paiement).
     * URL a declarer : route('payment.wave.webhook') -> /webhook/wave
     *
     * Note d'idempotence : Wave peut re-envoyer un webhook. Comme on re-cherche la
     * ligne avec `latest('id')` et qu'on re-ecrit raw_payload, un doublon reste sans
     * effet de bord bloquant (le statut paid est reconfirme).
     */
    public function handle(Request $request)
    {
        // 1) Securite : rejeter tout webhook dont la signature Wave est invalide.
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

        // 2) On ne traite que l'evenement de paiement reussi.
        if ($eventType !== 'checkout.completed') {
            return response()->json(['status' => 'ignored']);
        }

        // 3) Sans identifiant, impossible de rattacher le paiement : on refoule.
        if (! $checkoutId && ! $clientReference) {
            Log::warning('Wave webhook: aucune reference (checkout_id/client_reference).');

            return response()->json(['error' => 'missing_reference'], 422);
        }

        // 4) On retrouve la trace `payments` creee par WaveCheckoutController.
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

        // 5) Mise a jour du statut selon ce que Wave nous dit.
        $hasSucceeded = ($data['payment_status'] ?? null) === 'succeeded'
            || ($data['checkout_status'] ?? null) === 'complete';

        if ($hasSucceeded) {
            // Paiement encaisse : on fige la trace (transaction_id + timestamp).
            $payment->update([
                'status' => Payment::STATUS_PAID,
                'payment_status' => 'succeeded',
                'checkout_status' => 'complete',
                'transaction_id' => $data['transaction_id'] ?? $payment->transaction_id,
                'raw_payload' => $data,
                'paid_at' => now(),
            ]);
        } elseif (($data['checkout_status'] ?? null) === 'expired') {
            // Session arrivera a expiration sans validation : reinit possible plus tard.
            $payment->update([
                'status' => Payment::STATUS_EXPIRED,
                'checkout_status' => 'expired',
                'raw_payload' => $data,
            ]);
        } else {
            // Echec (solde insuffisant, annulation, autre) : on conserve le motif.
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