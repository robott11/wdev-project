<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Testimony;
use Illuminate\Http\Request;
use PHPUnit\Util\Test;

class TestimonyController extends Controller
{
    public function index(): string
    {
        return view('pages.testimonies', [
            'testimonies' => Testimony::orderBy('created_at', 'desc')->paginate(2)
        ]);
    }
}
