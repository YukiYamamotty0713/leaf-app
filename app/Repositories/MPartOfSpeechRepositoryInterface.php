<?php

namespace App\Repositories;

interface MPartOfSpeechRepositoryInterface
{
    public function get() : object;
    public function getById(int $id) : String;
}