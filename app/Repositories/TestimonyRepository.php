<?php

namespace App\Repositories;

use App\Models\Testimony;
use Illuminate\Database\Eloquent\Builder;

class TestimonyRepository
{
    public function getTestimoniesByCreatedDate(): Builder
    {
        return Testimony::orderBy('created_at', 'desc');
    }

    public function createTestimony(string $name, string $message)
    {
        $testimony = new Testimony();
        $testimony->name = $name;
        $testimony->message = $message;
        $testimony->save();
    }
}
