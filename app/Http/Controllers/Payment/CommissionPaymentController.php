<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\User;
use App\Services\WavePaymentService;
use Illuminate\Http\Request;

/**
 * "Payer mes commissions" : le professionnel regle en une seule fois, via un
 * checkout Wave restreint a SON numero, tout le solde dû de commissions.
 *
 * La ligne `payments` creee ici est rattachee au pro lui-meme (payable = User).
 * A la confirmation (WaveWebhookController), toutes les commissions ouvertes
 * (payable = Intervention) de ce pro sont passees a `paid` : le solde baisse.
 */
class CommissionPaymentController extends Controller
{
    public function __construct(protected WavePaymentService $wave) {}

    public function pay(Request $request)
    {
        $user = $request->user();

        abort_unless($user->isProfessional(), 403);

        if (! $this->wave->configured()) {
            return back()->with('error', 'Le paiement Wave n\'est pas encore configure. Revenez plus tard.');
        }

        $due = $user->commissionBalanceDue();

        if ($due <= 0) {
            return back()->with('error', 'Aucune commission a payer pour le moment.');
        }

        if (blank($user->phone)) {
            return back()->with('error', 'Ajoutez votre numero de telephone a votre profil pour payer vos commissions par Wave.');
        }

        $dashboard = $user->isDepanneur() ? 'depanneur.dashboard' : 'remorqueur.dashboard';
        $reference = 'COM-PRO-'.$user->id.'-'.now()->format('YmdHis');

        $checkout = $this->wave->createCheckout($due, [
            'client_reference' => $reference,
            'restrict_payer_mobile' => $this->normalizePhone($user->phone),
            'success_url' => route($dashboard).'?paiement=success',
            'error_url' => route($dashboard).'?paiement=error',
        ]);

        Payment::create([
            'payable_type' => User::class,
            'payable_id' => $user->id,
            'user_id' => $user->id,
            'provider' => 'wave',
            'checkout_id' => $checkout['id'] ?? null,
            'transaction_id' => $checkout['transaction_id'] ?? null,
            'client_reference' => $reference,
            'amount' => $due,
            'currency' => 'XOF',
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

    /**
     * Normalise un numero senegalais vers le format international E.164 attendu par Wave :
     *   77 123 45 67  -> +221771234567
     *   221771234567  -> +221771234567
     */
    protected function normalizePhone(string $phone): string
    {
        $digits = preg_replace('/[^0-9]/', '', $phone);

        if (strlen($digits) === 9) {
            return '+221'.$digits;
        }

        if (strlen($digits) === 11 && str_starts_with($digits, '221')) {
            return '+'.$digits;
        }

        return $digits;
    }
}
