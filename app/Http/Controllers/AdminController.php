<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use App\Http\Requests\TestimonyRequest;
use App\Models\Admin;
use App\Models\Testimony;
use App\Services\AdminService;
use App\Services\TestimonyService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminController extends Controller
{
    private AdminService $service;

    private TestimonyService $testimonyService;

    public function __construct(AdminService $service, TestimonyService $testimonyService)
    {
        $this->middleware('admin.check');
        $this->service = $service;
        $this->testimonyService = $testimonyService;
    }

    public function index(): string
    {
        return view('admin.home');
    }

    public function getLogin(): string
    {
        return view('admin.login');
    }

    public function getTestimony(): string
    {
        return view('admin.testimonies', [
            'testimonies' => Testimony::orderBy('created_at', 'desc')->paginate(5)
        ]);
    }

    public function getUsers(): string
    {
        return view('admin.users', [
            'users' => Admin::orderBy('created_at', 'desc')->paginate(5)
        ]);
    }

    public function postLogin(AdminLoginRequest $request): RedirectResponse
    {
        $credentials = $request->validated();

        try {
            $this->service->login($request, $credentials);
            return redirect()->route('admin.home');
        } catch (Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    public function getLogout(): RedirectResponse
    {
        $this->service->logout();

        return redirect()->route('admin.login');
    }

    public function getDelete(Request $request): RedirectResponse|View
    {
        $testimony = $this->testimonyService->getTestimonyById($request->id);

        if ($testimony) {
            return view('admin.testimony-del', [
                'name' => $testimony['name'],
                'message' => $testimony['message']
            ]);
        }

        return back();
    }

    public function postDelete(Request $request): RedirectResponse
    {
        $this->testimonyService->deleteTestimony($request->id);

        return redirect()->route('admin.testimony')->with('status', 'Depoimento deletado.');
    }

    public function getEdit(Request $request): RedirectResponse|View
    {
        $testimony = $this->testimonyService->getTestimonyById($request->id);

        if($testimony) {
            return view('admin.testimony-edit', [
                'name' => $testimony['name'],
                'message' => $testimony['message']
            ]);
        }

        return back();
    }

    public function postEdit(TestimonyRequest $request): RedirectResponse
    {
        $editedTestimony = $request->validated();

        $this->testimonyService->editTestimony($request->id, $editedTestimony);

        return redirect()->route('admin.testimony')->with('status', 'Depoimento editado.');
    }
}
