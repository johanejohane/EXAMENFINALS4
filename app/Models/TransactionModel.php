<?php 

namespace App\Models;
use CodeIgniter\Model;
class TransactionModel extends Model
{
    protected $table ='transactions';
    protected $primaryKey ='id';
    protected $allowedFields=['type_operation_id','client_source_id','client_destination_id','operateur_source_id','operateur_destination_id','montant','frais','commission_interoperateur','frais_retrait_inclus','date_operation','epargne'];
    protected $returnType = 'array';
    
        public function historiqueClient(int $clientId, int $limit = 50)
    {
        return $this->select('transactions.*, types_operation.libelle as type_libelle')
                    ->join('types_operation', 'types_operation.id = transactions.type_operation_id')
                    ->groupStart()
                        ->where('client_source_id', $clientId)
                        ->orWhere('client_destination_id', $clientId)
                    ->groupEnd()
                    ->orderBy('date_operation', 'DESC')
                    ->limit($limit)
                    ->find();
    }
}
