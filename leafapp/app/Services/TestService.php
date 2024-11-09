<?php

namespace App\Services;

use App\Repositories\TestRepositoryInterface;

class TestService
{
    protected $TestRepositoryInterface;

    public function __construct(TestRepositoryInterface $TestRepositoryInterface)
    {
        $this->TestRepositoryInterface = $TestRepositoryInterface;
    }

    public function get()
    {
        return $this->TestRepositoryInterface->get();
    }
}