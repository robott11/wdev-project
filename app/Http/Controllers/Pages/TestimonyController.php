<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestimonyRequest;
use App\Repositories\TestimonyRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TestimonyController extends Controller
{
    private TestimonyRepository $repository;

    public function __construct(TestimonyRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getTestimonies(): View
    {
        return view('pages.testimonies', [
            'testimonies' => $this->repository->getTestimoniesByCreatedDate()->paginate(2)
        ]);
    }

    public function postTestimony(TestimonyRequest $request): RedirectResponse
    {
        $formTestimony = $request->validated();

        $this->repository->createTestimony($formTestimony);

        return redirect()->route('testimony')->with('status', 'Depoimento criado!');
    }
}
