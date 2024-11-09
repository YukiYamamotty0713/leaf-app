<?php

namespace App\Services;

use App\Repositories\SampleRepositoryInterface;

class SampleService
{
    protected $SampleRepositoryInterface;

    public function __construct(SampleRepositoryInterface $SampleRepositoryInterface)
    {
        $this->SampleRepositoryInterface = $SampleRepositoryInterface;
    }

    public function get()
    {
        return $this->SampleRepositoryInterface->get();
    }
}