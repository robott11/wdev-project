<?php

namespace App\Repositories;

use App\Models\Admin;
use Exception;
use Illuminate\Support\Facades\Auth;

class AdminRepository
{
    public function getAdminByEmail(string $email): Admin|null
    {
        return Admin::where('email', '=', $email)->first();
    }

    public function attemptAuthenticate(array $credentials)
    {
        $email = $credentials['email'];
        $password = $credentials['password'];

        if (!$this->getAdminByEmail($email)) {
            throw new Exception('Essa conta não existe');
        }

        if (!Auth::guard('admin')->attempt($credentials)) {
            throw new Exception('Senha incorreta');
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
    }
}
