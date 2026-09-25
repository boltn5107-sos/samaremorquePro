<?php

namespace App\Services;

use App\Models\Intervention;
use App\Models\Payment;
use Illuminate\Support\Str;

/**
 * Gestion de la commission (Option B) :
 *  - une commission est creee quand le client valide le prix d'une intervention ;
 *  - elle alimente le solde dû du professionnel jusqu'a son paiement via Wave ;
 *  - le seuil de blocage est calcule depuis config('wave.*').
 */
class CommissionService
{
    public function amount(): int
    {
        return (int) config('wave.commission_amount', 750);
    }

    public function blockThreshold(): int
    {
        return $this->amount() * max(1, (int) config('wave.commission_block_after', 3));
    }

    /**
     * Enregistre (ou met a jour) la commission d'une intervention dont le prix
     * vient d'etre valide par le client. Retourne la ligne Payment creee.
     */
    public function charge(Intervention $intervention): ?Payment
    {
        if (! $intervention->professional_id || ! $intervention->professional?->isProfessional()) {
            return null;
        }

        $amount = $this->amount();

        return Payment::updateOrCreate(
            [
                'payable_type' => Intervention::class,
                'payable_id' => $intervention->id,
            ],
            [
                'user_id' => $intervention->professional_id,
                'provider' => 'wave',
                'amount' => $amount,
                'currency' => 'XOF',
                'status' => Payment::STATUS_PENDING,
                'client_reference' => 'COM-'.$intervention->id.'-'.strtoupper(Str::random(4)),
            ]
        );
    }
}
