<?php

namespace App\Repositories;
use App\Enums\MPartOfSpeech;
interface DashboardRepositoryInterface
{
    public function get();
    public function getAll();
    public function count(MPartOfSpeech $mPartOfSpeech);
}