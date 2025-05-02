<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\MyWordsRepositoryInterface;
use Illuminate\Support\Facades\Log;
use App\Models\UserWord;

class AccomplishedWordsService
{
    protected $MyWordsRepositoryInterface;

    public function __construct(MyWordsRepositoryInterface $MyWordsRepositoryInterface)
    {
        $this->MyWordsRepositoryInterface = $MyWordsRepositoryInterface;
    }

    public function get():UserWord | null
    {
        return $this->MyWordsRepositoryInterface->get();
    }
}