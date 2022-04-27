<?php

namespace App\Services;

use App\Repositories\AdminRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminService
{
    private AdminRepository $adminRepository;

    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function login(Request $request, array $credentials)
    {
        $email = $credentials['email'];
        $password = $credentials['password'];

        if (!$adminInfo = $this->adminRepository->getAdminByEmail($email)) {
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
