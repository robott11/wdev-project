<?php

namespace App\Repositories;

use App\Models\Testimony;

class TestimonyRepository
{
    public function getTestimoniesByCreatedDate()
    {
        return Testimony::orderBy('created_at', 'desc');
    }

    public function createTestimony(array $formTestimony)
    {
        $testimony = new Testimony();
        $testimony->name = $formTestimony['name'];
        $testimony->message = $formTestimony['message'];
        $testimony->save();
    }

    public function getTestimonyById($id)
    {
        return Testimony::find($id);
    }

    public function deleteTestimony($id)
    {
        $model = Testimony::find($id);
        $model?->delete();
    }

    public function editTestimony($id, array $data)
    {
        $model = Testimony::find($id);

        if ($model) {
            $model->name = $data['name'];
            $model->message = $data['message'];
            $model->save();
        }
    }
}
