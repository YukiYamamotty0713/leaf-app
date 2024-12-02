<?php
namespace App\Repositories;
use App\Models\MPartOfSpeech;
use App\Repositories\MPartOfSpeechRepositoryInterface;

class MPartOfSpeechRepository implements MPartOfSpeechRepositoryInterface
{
    public function get() : object
    {
        return MPartOfSpeech::all();
    }
}