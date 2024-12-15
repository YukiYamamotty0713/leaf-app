<?php

namespace App\Services;

use App\Repositories\DashboardRepositoryInterface;
use App\Repositories\DailyActivityRepositoryInterface;
use App\Enums\MPartOfSpeech;

use App\DTO\WeeklyActivityDTO;
use App\DTO\ActivityDTO;
use Carbon\Carbon;

class DashboardService
{
    protected $DashboardRepositoryInterface;
    protected $DailyActivityRepositoryInterface;

    public function __construct(DashboardRepositoryInterface $DashboardRepositoryInterface,
                                DailyActivityRepositoryInterface $DailyActivityRepositoryInterface)
    {
        $this->DashboardRepositoryInterface = $DashboardRepositoryInterface;
        $this->DailyActivityRepositoryInterface = $DailyActivityRepositoryInterface;
    }

    /**
     * 登録した合計の単語数を取得
     */
    public function getResisterWordsCounts(): array
    {
        $counts = [];
        $sum = 0;  // 合計を格納する変数
        foreach (MPartOfSpeech::cases() as $partOfSpeech) {
            $count = $this->DashboardRepositoryInterface->count($partOfSpeech);
            $counts[$partOfSpeech->name] = $count;
            $sum += $count;  // 合計に加算
        }
        $counts["Sum"] = $sum;
        return $counts;
    }

    public function getTotalActivitiy(): array
    {
        return $this->DailyActivityRepositoryInterface->get();
    }

    public function getWeeklyActivity(): WeeklyActivityDTO
    {
        //今日から7日前までの日付を取得
        $days = [];
        $activities = [];
        for ($i = 0; $i < 7; $i++) {
            $date = Carbon::today()->subDays($i);
            $days[] = $date->format('Y-m-d');
            $activities[] = $this->getDailyActivity($date);
        }

        $dto =  new WeeklyActivityDTO($days, $activities);
        return $dto;

    }

    private function getDailyActivity(Carbon $date): ActivityDTO
    {
        $dto =  new ActivityDTO(
            $this->DailyActivityRepositoryInterface->getRegisterByDate($date),
            $this->DailyActivityRepositoryInterface->getDeleteByDate($date)
        );
        return $dto;
    }
}