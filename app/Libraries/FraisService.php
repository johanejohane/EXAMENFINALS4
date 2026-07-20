<?php
namespace App\Libraries;

use App\Models\BaremeFraisModel;

class FraisService
{
    protected $baremeModel;

    public function __construct()
    {
        $this->baremeModel = new BaremeFraisModel();
    }

    /**
     * Calcule le frais applicable pour un type d'opération et un montant donné,
     * en cherchant la tranche du barème dans laquelle le montant tombe.
     * Retourne 0 si aucune tranche ne correspond (cas à gérer côté appelant).
     */
    public function calculer(int $typeOperationId, float $montant): float
    {
        $bareme = $this->baremeModel
            ->where('type_operation_id', $typeOperationId)
            ->where('montant_min <=', $montant)
            ->groupStart()
                ->where('montant_max >=', $montant)
                ->orWhere('montant_max', null)
            ->groupEnd()
            ->first();

        if (!$bareme) {
            return 0.0;
        }

        if ($bareme['frais_type'] === 'pourcentage') {
            return round($montant * ((float) $bareme['frais'] / 100), 2);
        }

        return (float) $bareme['frais'];
    }
}