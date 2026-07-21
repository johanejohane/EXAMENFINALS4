<?php 

namespace App\Models;

use CodeIgniter\Model;

class PourcentageEpargneModel extends Model
{
    protected $table = 'pourcentage_epargne';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_client','porcentage'];

    
}