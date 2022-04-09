<?php

namespace App\Repositories;

use App\Models\Testimony;
use Illuminate\Database\Eloquent\Builder;

class TestimonyRepository
{
    private Testimony $testimony;

    public function __construct(Testimony $testimony)
    {
        $this->testimony = $testimony;
    }

    public function getTestimoniesByCreatedDate(): Builder
    {
        return Testimony::orderBy('created_at', 'desc');
    }

    public function createTestimony(string $name, string $message)
    {
        $this->testimony->name = $name;
        $this->testimony->message = $message;
        $this->testimony->save();
    }
}
