<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use App\Http\Requests\TestimonyRequest;
use App\Models\Admin;
use App\Models\Testimony;
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

    public function getTestimonyPage(): string
    {
        return view('admin.testimonies', [
            'testimonies' => Testimony::orderBy('created_at', 'desc')->paginate(5)
        ]);
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

    public function logout(): RedirectResponse|null
    {
        if (session()->has('LoggedAdmin')) {
            session()->pull('LoggedAdmin');

            return redirect()->route('admin.login');
        }

        return null;
    }

    public function getDeleteTestimonyPage(Request $request): RedirectResponse|string
    {
        $testimony = Testimony::find($request->id);

        if ($testimony) {
            return view('admin.testimony-del', [
                'name' => $testimony->name,
                'message' => $testimony->message
            ]);
        }

        return back();
    }

    public function deleteTestimony(Request $request): RedirectResponse
    {
        $testimony = Testimony::find($request->id);

        if($testimony) {
            $testimony->delete();

            return redirect()->route('admin.testimony')->with('status', 'Depoimento deletado.');
        }

        return back();
    }

    public function getEditTestimonyPage(Request $request): RedirectResponse|string
    {
        $testimony = Testimony::find($request->id);

        if($testimony) {
            return view('admin.testimony-edit', [
                'name' => $testimony->name,
                'message' => $testimony->message
            ]);
        }

        return back();
    }

    public function editTestimony(TestimonyRequest $request): RedirectResponse
    {
        $editedTestimony = $request->validated();

        $testimony = Testimony::find($request->id);

        if ($testimony) {
            $testimony->name = $request['name'];
            $testimony->message = $request['message'];
            $testimony->save();

            return redirect()->route('admin.testimony')->with('status', 'Depoimento editado.');
        }

        return back();
    }
}
