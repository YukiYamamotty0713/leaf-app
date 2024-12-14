<?php

namespace App\Repositories;

use App\Models\DailyActivity;
use Illuminate\Support\Facades\Auth;
use App\Repositories\DailyActivityRepositoryInterface;
class DailyActivityRepository implements DailyActivityRepositoryInterface
{
    /**
     * 登録処理
     *
     * @return void
     */
    public function register(): void
    {
        DailyActivity::create([
            "user_id" => Auth::id(), // 現在認証中のユーザーID
            "activity" => "register",
        ]);
    }

    /**
     * 削除処理
     *
     * @return void
     */
    public function delete(): void
    {
        DailyActivity::create([
            "user_id" => Auth::id(), // 現在認証中のユーザーID
            "activity" => "delete",
        ]);
    }

    public function get()
    {
        $res = [
            $this->getRegister(),
            $this->getDelete(),
        ];
        return $res;
    }

    private function getRegister()
    {
        return DailyActivity::where('user_id', Auth::id())->where('activity', 'register')->count();
    }

    private function getDelete()
    {
        return DailyActivity::where('user_id', Auth::id())->where('activity', 'delete')->count();
    }
}