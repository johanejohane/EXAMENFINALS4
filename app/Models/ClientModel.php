<?php

namespace App\Models;

use CodeIgniter\Model;

class ClientModel extends Model
{
    protected $table = 'clients';
    protected $primaryKey = 'id';
    protected $allowedFields = ['numero', 'nom', 'solde'];

    // Recherche un client à partir de son numéro de téléphone (utilisé au login)
    public function findByNumero(string $numero)
    {
        return $this->where('numero', $numero)->first();
    }

    // Augmente le solde d'un client d'un certain montant
    public function crediter(int $id, float $montant): bool
    {
        return $this->set('solde', 'solde + ' . $montant, false)
                     ->where('id', $id)
                     ->update();
    }

    // Diminue le solde d'un client d'un certain montant
    public function debiter(int $id, float $montant): bool
    {
        return $this->set('solde', 'solde - ' . $montant, false)
                     ->where('id', $id)
                     ->update();
    }
}