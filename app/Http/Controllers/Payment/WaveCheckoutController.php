<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Intervention;
use App\Models\Payment;
use App\Services\WavePaymentService;
use Illuminate\Http\Request;

class WaveCheckoutController extends Controller
{
    public function __construct(protected WavePaymentService $wave) {}

    /**
     * Affiche la page de paiement (bouton "Payer par Wave").
     */
    public function show(Request $request, Intervention $intervention)
    {
        if ($intervention->client_id !== $request->user()?->id && ! $request->user()?->isAdmin()) {
            abort(403);
        }

        $payment = Payment::query()
            ->where('payable_type', Intervention::class)
            ->where('payable_id', $intervention->id)
            ->whereIn('status', [Payment::STATUS_PENDING, Payment::STATUS_PROCESSING])
            ->latest('id')
            ->first();

        return view('payment.pay', compact('intervention', 'payment'));
    }

    /**
     * Cree une session de checkout Wave et redirige l'utilisateur.
     */
    public function store(Request $request, Intervention $intervention)
    {
        if ($intervention->client_id !== $request->user()?->id && ! $request->user()?->isAdmin()) {
            abort(403);
        }

        $validated = $request->validate([
            'amount' => ['required', 'numeric', 'min:100'],
            'phone' => ['nullable', 'string', 'max:20'],
        ]);

        if (! $this->wave->configured()) {
            return back()->with('error', 'Le paiement Wave n\'est pas encore configure. Revenez plus tard.');
        }

        $reference = 'INT-' . $intervention->id . '-' . strtoupper(substr($intervention->tracking_code, -4));

        $checkout = $this->wave->createCheckout((int) round($validated['amount']), [
            'client_reference' => $reference,
            'restrict_payer_mobile' => ! empty($validated['phone']) ? $this->normalizePhone($validated['phone']) : null,
        ]);

        Payment::create([
            'payable_type' => Intervention::class,
            'payable_id' => $intervention->id,
            'user_id' => $intervention->client_id,
            'provider' => 'wave',
            'checkout_id' => $checkout['id'] ?? null,
            'transaction_id' => $checkout['transaction_id'] ?? null,
            'client_reference' => $reference,
            'amount' => $validated['amount'],
            'currency' => config('wave.currency', 'XOF'),
            'status' => Payment::STATUS_PENDING,
            'checkout_status' => $checkout['checkout_status'] ?? 'open',
            'payment_status' => $checkout['payment_status'] ?? null,
            'raw_payload' => $checkout,
        ]);

        $launchUrl = $checkout['wave_launch_url'] ?? null;

        if (! $launchUrl) {
            return back()->with('error', 'Impossible de demarrer le paiement Wave.');
        }

        return redirect()->away($launchUrl);
    }

    protected function normalizePhone(string $phone): string
    {
        $digits = preg_replace('/[^0-9]/', '', $phone);

        if (strlen($digits) === 9) {
            return '+221' . $digits;
        }

        if (strlen($digits) === 11 && str_starts_with($digits, '221')) {
            return '+' . $digits;
        }

        return $digits;
    }
}