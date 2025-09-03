<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class GuestFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        
        if ($session->get('logged_in')) {
            $role = $session->get('role');
            
            // Handle AJAX requests
            if ($request->isAJAX()) {
                $redirectUrl = $role === 'admin' ? base_url('admin/dashboard') : base_url();
                return service('response')->setJSON([
                    'status' => 'redirect',
                    'message' => 'Anda sudah login. Mengalihkan ke dashboard...',
                    'redirect' => $redirectUrl
                ])->setStatusCode(200);
            }
            
            // Redirect based on role
            return redirect()->to($role === 'admin' ? '/admin/dashboard' : '/');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}
