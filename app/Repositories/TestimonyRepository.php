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

    public function getTestimonyById($id): array|null
    {
        $model = Testimony::find($id);

        if ($model) {
            return [
                'id' => $model->id,
                'name' => $model->name,
                'message' => $model->message,
                'created_at' => $model->created_at,
                'updated_at' => $model->updated_at
            ];
        }

        return null;
    }

    public function deleteTestimonyIfExists($id)
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
