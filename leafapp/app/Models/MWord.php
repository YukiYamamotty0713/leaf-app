<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MWord extends Model
{
    /**
     * テーブル名の指定
     *
     * @var string
     */
    protected $table = 'm_word';

    /**
     * @var array
     */
    protected $guarded = []; // すべてのカラムがマスアサインメント可能

}
