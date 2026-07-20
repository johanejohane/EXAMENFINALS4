<?php

namespace App\Models;

use CodeIgniter\Model;

class CompteOperateurModel extends Model
{
    protected $table = 'comptes_operateurs';
    protected $primaryKey = 'id';
    protected $allowedFields = ['operateur_id', 'solde'];

    public function crediter(int $operateurId, float $montant): bool
    {
        return $this->set('solde', 'solde + ' . $montant, false)
                    ->where('operateur_id', $operateurId)
                    ->update();
    }

    public function debiter(int $operateurId, float $montant): bool
    {
        return $this->set('solde', 'solde - ' . $montant, false)
                    ->where('operateur_id', $operateurId)
                    ->update();
    }
}
