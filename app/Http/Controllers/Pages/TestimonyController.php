<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestimonyRequest;
use App\Models\Testimony;
use App\Repositories\TestimonyRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TestimonyController extends Controller
{
    private TestimonyRepository $repository;

    public function __construct(TestimonyRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(): string
    {
        return view('pages.testimonies', [
            'testimonies' => $this->repository->getTestimoniesByCreatedDate()->paginate(2)
        ]);
    }

    public function create(TestimonyRequest $request): RedirectResponse
    {
        $formTestimony = $request->validated();
        $name = $formTestimony['name'];
        $message = $formTestimony['message'];

        $this->repository->createTestimony($name, $message);

        return redirect()->route('testimony')->with('status', 'Depoimento criado!');
    }
}
