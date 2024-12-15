<?php

namespace App\DTO;

use App\DTO\ActivityDTO;
use Carbon\Carbon;
use InvalidArgumentException;

class WeeklyActivityDTO
{
    /**
     * @var Carbon[] 日付の配列（Carbonインスタンス）
     */
    public array $days;

    /**
     * @var ActivityDTO[] アクティビティデータの配列
     */
    public array $activities;

    public function __construct(array $days, array $activities)
    {
        $this->validateDays($days);
        $this->validateActivities($activities);
        
        $this->days = $days;
        $this->activities = $activities;
    }

    /**
     * 日付配列が7つであること、かつすべてが有効な日付であることをバリデート
     */
    private function validateDays(array $days): void
    {
        if (count($days) !== 7) {
            throw new InvalidArgumentException('The days array must contain exactly 7 elements.');
        }

        foreach ($days as $day) {
            if (!Carbon::hasFormat($day, 'Y-m-d')) {
                throw new InvalidArgumentException("Invalid date format in days array: $day. Expected format: Y-m-d");
            }
        }
    }

    /**
     * アクティビティ配列が7つであること、かつすべてがActivityDTOであることをバリデート
     */
    private function validateActivities(array $activities): void
    {
        if (count($activities) !== 7) {
            throw new InvalidArgumentException('The activities array must contain exactly 7 elements.');
        }

        foreach ($activities as $activity) {
            if (!$activity instanceof ActivityDTO) {
                throw new InvalidArgumentException('All elements in the activities array must be instances of ActivityDTO.');
            }
        }
    }
}
