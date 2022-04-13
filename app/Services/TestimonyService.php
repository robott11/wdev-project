<?php

namespace App\Services;

use App\Repositories\TestimonyRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class TestimonyService
{
    private TestimonyRepository $testimonyRepository;

    public function __construct(TestimonyRepository $testimonyRepository)
    {
        $this->testimonyRepository = $testimonyRepository;
    }

    public function getTestimoniesPerPage(int $pages = 2): LengthAwarePaginator
    {
        return $this->testimonyRepository->getTestimoniesByCreatedDate()->paginate($pages);
    }

    public function createTestimony(array $testimony)
    {
        $this->testimonyRepository->createTestimony($testimony['name'], $testimony['message']);
    }

    public function getTestimonyById($id): array|null
    {
        return $this->testimonyRepository->getTestimonyById($id);
    }

    public function deleteTestimony($id)
    {
        $this->testimonyRepository->deleteTestimonyIfExists($id);
    }

    public function editTestimony($id, array $data)
    {
        $this->testimonyRepository->editTestimony($id, $data);
    }
}
