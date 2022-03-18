<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestimonyRequest;
use App\Models\Testimony;
use Illuminate\Http\Request;

class TestimonyController extends Controller
{
    public function index(): string
    {
        return view('pages.testimonies', [
            'testimonies' => Testimony::orderBy('created_at', 'desc')->paginate(2)
        ]);
    }

    public function create(TestimonyRequest $request)
    {
        $formTestimony = $request->validated();

        $testimony = new Testimony();
        $testimony->name = $formTestimony['name'];
        $testimony->message = $formTestimony['message'];
        $testimony->save();

        return redirect()->route('testimony')->with('status', 'Depoimento criado!');
    }
}
