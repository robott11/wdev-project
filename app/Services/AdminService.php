<?php

namespace App\Services;

use App\Repositories\AdminRepository;
use Exception;
use Illuminate\Http\Request;
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

        $adminInfo = $this->adminRepository->getAdminByEmail($email);

        if (!$adminInfo) {
            throw new Exception('Essa conta não existe');
        }

        if (!Hash::check($password, $adminInfo->password)) {
            throw new Exception('Senha incorreta');
        }

        $request->session()->put('LoggedAdmin', $adminInfo->id);
    }

    public function logout()
    {
        if (session()->has('LoggedAdmin')) {
            session()->pull('LoggedAdmin');
        }
    }
}
