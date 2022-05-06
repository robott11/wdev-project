<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use App\Http\Requests\TestimonyRequest;
use App\Models\Admin;
use App\Models\Testimony;
use App\Repositories\AdminRepository;
use App\Services\TestimonyService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminController extends Controller
{
    private AdminRepository $repository;

    private TestimonyService $testimonyService;

    public function __construct(AdminRepository $repository, TestimonyService $testimonyService)
    {
        $this->middleware('admin.check');
        $this->repository = $repository;
        $this->testimonyService = $testimonyService;
    }

    public function index(): View
    {
        return view('admin.home');
    }

    public function getLogin(): View
    {
        return view('admin.login');
    }

    public function getTestimony(): View
    {
        return view('admin.testimonies', [
            'testimonies' => Testimony::orderBy('created_at', 'desc')->paginate(5)
        ]);
    }

    public function getUsers(): View
    {
        return view('admin.users', [
            'users' => Admin::orderBy('created_at', 'desc')->paginate(5)
        ]);
    }

    public function postLogin(AdminLoginRequest $request): RedirectResponse
    {
        $credentials = $request->validated();

        try {
            $this->repository->attemptAuthenticate($credentials);

            return redirect()->route('admin.home');
        } catch (Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    public function getLogout(): RedirectResponse
    {
        $this->repository->logout();

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
