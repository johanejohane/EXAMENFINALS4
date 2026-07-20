<?php
namespace App\Models;
use CodeIgniter\Model;
class BaremeFraisModel extends Model
{

    protected $table = 'baremes_frais';
    protected $primaryKey = 'id';
    protected $allowedFields = ['type_operation_id', 'montant_min', 'montant_max', 'frais', 'frais_type'];

    public function chevauche(int $typeOperationId, float $montantMin, ?float $montantMax, ?int $idExclu = null): bool
    {
        $builder = $this->where('type_operation_id', $typeOperationId)
                        ->groupStart()
                            ->where('montant_max', null)
                            ->orWhere('montant_max >=', $montantMin)
                        ->groupEnd();

        if ($montantMax !== null) {
            $builder->where('montant_min <=', $montantMax);
        }

        if ($idExclu !== null) {
            $builder->where('id !=', $idExclu);
        }

        return $builder->first() !== null;
    }

    public function calculerFrais(int $typeOperationId, float $montant): float
    {
        $bareme = $this->where('type_operation_id', $typeOperationId)
                        ->where('montant_min <=', $montant)
                        ->groupStart()
                            ->where('montant_max >=', $montant)
                            ->orWhere('montant_max', null)
                        ->groupEnd()
                        ->first();

        if (! $bareme) {
            return 0.0;
        }

        if ($bareme['frais_type'] === 'pourcentage') {
            return round($montant * ((float) $bareme['frais'] / 100), 2);
        }

        return (float) $bareme['frais'];
    }
}
