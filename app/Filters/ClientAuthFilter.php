<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class ClientAuthFilter implements FilterInterface
{
    // Exécuté avant chaque page protégée : si le client n'est pas connecté, on le renvoie au login
    public function before(RequestInterface $request, $arguments = null)
    {
        if (! session('isLoggedIn')) {
            return redirect()->to('/client/login');
        }
    }

    // Exécuté après la réponse : rien à faire ici, mais obligatoire (interface FilterInterface)
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // rien à faire après
    }
}