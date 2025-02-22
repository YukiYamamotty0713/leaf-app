<?php

namespace App\Services;

use App\Repositories\MyWordsRepositoryInterface;
use Illuminate\Support\Facades\Log;
class AccomplishedWordsService
{
    protected $MyWordsRepositoryInterface;

    public function __construct(MyWordsRepositoryInterface $MyWordsRepositoryInterface)
    {
        $this->MyWordsRepositoryInterface = $MyWordsRepositoryInterface;
    }

    public function get()
    {
        Log::debug($this->MyWordsRepositoryInterface->getAccomplishedWords());
        return $this->MyWordsRepositoryInterface->getAccomplishedWords();
    }
}