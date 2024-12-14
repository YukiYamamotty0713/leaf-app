<?php

namespace App\Services;

use App\Repositories\DashboardRepositoryInterface;
use App\Repositories\DailyActivityRepositoryInterface;
use App\Enums\MPartOfSpeech;
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
}