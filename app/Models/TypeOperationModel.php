<?php

namespace App\Models;

use CodeIgniter\Model;

class TypeOperationModel extends Model
{
    protected $table = 'types_operation';
    protected $primaryKey = 'id';
    protected $allowedFields = ['code', 'libelle'];

    // Récupère un type d'opération (depot / retrait / transfert) à partir de son code
    public function getByCode(string $code)
    {
        return $this->where('code', $code)->first();
    }
  protected $returnType = 'array';
}