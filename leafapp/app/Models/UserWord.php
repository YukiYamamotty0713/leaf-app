<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MPartOfSpeech;
class UserWord extends Model
{
    /**
     * テーブル名の指定
     *
     * @var string
     */
    protected $table = 'user_word';

    /**
     * @var array
     */
    protected $guarded = []; // すべてのカラムがマスアサインメント可能

    public function mPartOfSpeech()
    {
        return $this->belongsTo(MPartOfSpeech::class,'part_of_speech_id'); // `m_part_of_speech_id` が外部キーであると仮定
    }
}
