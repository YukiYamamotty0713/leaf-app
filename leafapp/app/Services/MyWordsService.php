<?php

namespace App\Services;
use Illuminate\Http\JsonResponse;

use App\Repositories\MyWordsRepositoryInterface;
use Illuminate\Database\Eloquent\Casts\Json;

class MyWordsService
{
    protected $MyWordsRepositoryInterface;

    public function __construct(MyWordsRepositoryInterface $MyWordsRepositoryInterface)
    {
        $this->MyWordsRepositoryInterface = $MyWordsRepositoryInterface;
    }

    public function get()
    {
        return $this->MyWordsRepositoryInterface->get();
    }

    public function delete(int $id) :JsonResponse
    {
        try {
            $this->MyWordsRepositoryInterface->find($id);
            return new JsonResponse(['message' => 'Word deleted.'], 200);
        } catch (\Exception $e) {
            return new JsonResponse(['message' => 'Failed to delete word.'], 500);
        }
    }
}