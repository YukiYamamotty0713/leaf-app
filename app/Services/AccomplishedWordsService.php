<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\MyWordsRepositoryInterface;
use Illuminate\Support\Facades\Log;
use App\Models\UserWord;
use Illuminate\Support\Collection;
class AccomplishedWordsService
{
    protected $MyWordsRepositoryInterface;

    public function __construct(MyWordsRepositoryInterface $MyWordsRepositoryInterface)
    {
        $this->MyWordsRepositoryInterface = $MyWordsRepositoryInterface;
    }

    public function get(): Collection | UserWord | null
    {
        return $this->MyWordsRepositoryInterface->get();
    }
}