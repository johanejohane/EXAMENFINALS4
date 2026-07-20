<?php
namespace App\Models;

use CodeIgniter\Model;

class BaremeFraisModel extends Model
{
    protected $table = 'baremes_frais';
    protected $primaryKey = 'id';
    protected $allowedFields = ['type_operation_id', 'montant_min', 'montant_max', 'frais', 'frais_type'];
    protected $returnType = 'array';

    /**
     * Vérifie si une tranche [montantMin, montantMax] chevauche une tranche
     * déjà existante pour le même type d'opération.
     * montantMax peut être null (= pas de plafond, tranche "et plus").
     * $excludeId sert à s'exclure soi-même lors d'une modification.
     */
    public function chevauche($typeOperationId, $montantMin, $montantMax, $excludeId = null): bool
    {
        $builder = $this->where('type_operation_id', $typeOperationId);
        if ($excludeId !== null) {
            $builder->where('id !=', $excludeId);
        }
        $baremes = $builder->findAll();

        foreach ($baremes as $b) {
            $existingMin = (float) $b['montant_min'];
            $existingMax = $b['montant_max'] !== null ? (float) $b['montant_max'] : null;

            // Deux intervalles [a,b] et [c,d] (b ou d pouvant être "infini") se chevauchent
            // si a <= d (ou d infini) ET c <= b (ou b infini).
            $debutOk = ($existingMax === null) || ($montantMin <= $existingMax);
            $finOk   = ($montantMax === null) || ($existingMin <= $montantMax);

            if ($debutOk && $finOk) {
                return true;
            }
        }
        return false;
    }
}