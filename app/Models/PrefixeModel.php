<?php 

namespace App\Models;
use CodeIgniter\Model;
class PrefixeModel extends Model
{
    protected $table = 'prefixes';
    protected $primaryKey = 'id';
    protected $allowedFields = ['prefixe','libelle', 'operateur_id'];

        // Vérifie que les 3 premiers chiffres du numéro correspondent à un préfixe connu (Airtel, Orange, Yas...)
    public function estValide(string $prefixe)
    {
        $prefixe = substr($prefixe, 0, 3); // On prend les 3 premiers caractères du numéro
        return (bool) $this->where('prefixe', $prefixe)->first();
    }

}
