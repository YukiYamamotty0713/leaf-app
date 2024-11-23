<?php

namespace App\Services;

use App\Repositories\MyWordsRepositoryInterface;

class MyWordsService
{
    protected $MyWordsServiceRepositoryInterface;

    public function __construct(MyWordsRepositoryInterface $MyWordsServiceRepositoryInterface)
    {
        $this->MyWordsServiceRepositoryInterface = $MyWordsServiceRepositoryInterface;
    }

    public function get()
    {
        return $this->MyWordsServiceRepositoryInterface->get();
    }
}