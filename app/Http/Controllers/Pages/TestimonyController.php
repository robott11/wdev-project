<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestimonyRequest;
use App\Services\TestimonyService;
use Illuminate\Http\RedirectResponse;

class TestimonyController extends Controller
{
    private TestimonyService $service;

    public function __construct(TestimonyService $service)
    {
        $this->service = $service;
    }

    public function getTestimonies(): string
    {
        return view('pages.testimonies', [
            'testimonies' => $this->service->getTestimoniesPerPage()
        ]);
    }

    public function postTestimony(TestimonyRequest $request): RedirectResponse
    {
        $formTestimony = $request->validated();

        $this->service->createTestimony($formTestimony);

        return redirect()->route('testimony')->with('status', 'Depoimento criado!');
    }
}
