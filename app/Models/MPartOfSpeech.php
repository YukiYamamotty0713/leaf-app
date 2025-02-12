<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MPartOfSpeech extends Model
{
    //idとnamwを取得する
    protected $fillable = ['id', 'name'];

    protected $table = 'm_part_of_speech';

    public function userWords()
    {
        return $this->hasOne(UserWord::class);
    }
}
