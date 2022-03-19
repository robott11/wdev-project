<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class AdminController extends Controller
{
    public function index(): string
    {
        return view('admin.home');
    }

    public function getLoginPage(): string
    {
        return view('admin.login');
    }

    public function login(AdminLoginRequest $request): RedirectResponse
    {
        $credentials = $request->validated();

        $adminInfo = Admin::where('email', '=', $credentials['email'])->first();

        if (!$adminInfo) {
            return back()->withErrors('Essa conta não existe');
        }

        if (Hash::check($credentials['password'], $adminInfo->password)) {
            $request->session()->put('LoggedAdmin', $adminInfo->id);

            return redirect()->route('admin.home');
        }

        return back()->withErrors('Senha incorreta.');
    }

    public function logout(): RedirectResponse
    {
        if (session()->has('LoggedAdmin')) {
            session()->pull('LoggedAdmin');

            return redirect()->route('admin.login');
        }
    }
}
