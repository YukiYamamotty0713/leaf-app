<?php

namespace App\Services;

use App\Repositories\RegisterWordsRepositoryInterface;

class RegisterWordsService
{
    protected $RegisterWordsRepositoryInterface;

    public function __construct(RegisterWordsRepositoryInterface $RegisterWordsRepositoryInterface)
    {
        $this->RegisterWordsRepositoryInterface = $RegisterWordsRepositoryInterface;
    }

    public function get()
    {
        return $this->RegisterWordsRepositoryInterface->get();
    }
}