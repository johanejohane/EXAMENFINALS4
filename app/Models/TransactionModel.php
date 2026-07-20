<?php
namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $table = 'transactions';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'type_operation_id',
        'client_source_id',
        'client_destination_id',
        'montant',
        'frais',
        'date_operation',
    ];
    protected $returnType = 'array';
}