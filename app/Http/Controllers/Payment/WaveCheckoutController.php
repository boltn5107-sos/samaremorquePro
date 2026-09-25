<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Intervention;
use App\Models\Payment;
use App\Services\WavePaymentService;
use Illuminate\Http\Request;

/**
 * Controleur du flux Wave Checkout cote web : affichage de la page de paiement
 * et creation de la session qui redirige vers Wave.
 *
 * Modele Option B : le PAYEUR est le professionnel (commission). Le montant saisi
 * est sa commission, et `restrict_payer_mobile` limite la validation a son numero
 * Wave. Ce controleur sert aussi de base generique (montant libre + telephone)
 * pour tout paiement initie sur le web.
 */
class WaveCheckoutController extends Controller
{
    public function __construct(protected WavePaymentService $wave) {}

    /**
     * Affiche la page de paiement (bouton "Payer par Wave").
     * Reutilise un checkout en cours (pending/processing) si la session existe deja,
     * afin d'eviter de creer plusieurs sessions pour une meme intervention.
     */
    public function show(Request $request, Intervention $intervention)
    {
        // Seul le client concerne (ou un admin) peut payer cette intervention.
        if ($intervention->client_id !== $request->user()?->id && ! $request->user()?->isAdmin()) {
            abort(403);
        }

        // Cherche une session de paiement encore ouverte pour cette intervention.
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
     *
     * Enregistre toujours une ligne `payments` (statut pending) AVANT la redirection :
     * c'est elle qui permet au webhook (WaveWebhookController) de rattacher la
     * confirmation de paiement a la bonne intervention / au bon professionnel.
     */
    public function store(Request $request, Intervention $intervention)
    {
        // Seul le client concerne (ou un admin) peut lancer le paiement de cette intervention.
        if ($intervention->client_id !== $request->user()?->id && ! $request->user()?->isAdmin()) {
            abort(403);
        }

        // Montant minimum 100 FCFA, telephone optionnel (on restreint le payeur si fourni).
        $validated = $request->validate([
            'amount' => ['required', 'numeric', 'min:100'],
            'phone' => ['nullable', 'string', 'max:20'],
        ]);

        // Pas de cle API = integration non finalisee, on bloque proprement le flux.
        if (! $this->wave->configured()) {
            return back()->with('error', 'Le paiement Wave n\'est pas encore configure. Revenez plus tard.');
        }

        // Reference metier lisible pour retrouver le paiement cote Wave.
        $reference = 'INT-'.$intervention->id.'-'.strtoupper(substr($intervention->tracking_code, -4));

        // restric_payer_mobile : seuls les comptes Wave associes a ce numero peuvent valider.
        $checkout = $this->wave->createCheckout((int) round($validated['amount']), [
            'client_reference' => $reference,
            'restrict_payer_mobile' => ! empty($validated['phone']) ? $this->normalizePhone($validated['phone']) : null,
        ]);

        // Trace locale du paiement (persistee dans la table payments).
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

        // Wave fournira un URL d'experience de paiement (launch url) sur lequel on redirige.
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
     *
     * @return string le numero au format accepte par l'API Wave.
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
