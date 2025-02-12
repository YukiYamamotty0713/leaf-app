<?php

namespace App\Repositories;

use App\Models\DailyActivity;
use Illuminate\Support\Facades\Auth;
use App\Repositories\DailyActivityRepositoryInterface;
use Carbon\Carbon;
class DailyActivityRepository implements DailyActivityRepositoryInterface
{
    /**
     * 登録処理
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
     * @return void
     */
    public function delete(): void
    {
        DailyActivity::create([
            "user_id" => Auth::id(), // 現在認証中のユーザーID
            "activity" => "delete",
        ]);
    }
    /**
     * 登録単語、削除単語の累計データを返す
     * @return array
     */
    public function get()
    {
        $res = [
            $this->getRegister(),
            $this->getDelete(),
        ];
        return $res;
    }
    /**
     * 登録単語数の累計データを返す
     * @return int
     */
    private function getRegister()
    {
        return DailyActivity::where('user_id', Auth::id())->where('activity', 'register')->count();
    }

    /**
     * 削除単語数の累計データを返す
     * @return int
     */
    private function getDelete()
    {
        return DailyActivity::where('user_id', Auth::id())->where('activity', 'delete')->count();
    }
    /**
     * ある日の登録単語数データを返す
     * @param Carbon
     * @return int
     */
    public function getRegisterByDate(Carbon $date)
    {
        return DailyActivity::where('user_id', Auth::id())->where('activity', 'register')->whereDate('created_at', $date)->count();
    }

    /**
     * ある日の削除単語数データを返す
     * @param Carbon
     * @return int
     */
    public function getDeleteByDate(Carbon $date)
    {
        return DailyActivity::where('user_id', Auth::id())->where('activity', 'delete')->whereDate('created_at', $date)->count();
    }
}