<?php

namespace App\Services\CommonService;

use Illuminate\Support\Facades\Auth;

class AuthService
{
    /**
     * 現在認証されているユーザーを取得
     */
    public function user()
    {
        return Auth::user();
    }

    /**
     * 現在認証されているユーザーのIDを取得
     * @return int
     */
    public function get_id()
    {
        return $this->user()->id;
    }
}