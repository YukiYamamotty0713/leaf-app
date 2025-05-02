<?php

namespace Tests\Unit\DTO;

use App\DTO\WeeklyActivityDTO;
use App\DTO\ActivityDTO;
use Carbon\Carbon;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class WeeklyActivityDTOTest extends TestCase
{
    /**
     * @private function
     * @description 有効なCarbonインスタンスの配列を生成する
     * @return array
     */
    private function validDays(): array
    {
        return collect(range(0, 6))->map(fn($i) => Carbon::parse("2024-01-01")->addDays($i)->format('Y-m-d'))->toArray();
    }



    /**
     * @private function
     * @description 有効なActivityDTOインスタンスの配列を生成する
     * @return array
     */
    private function validActivities(): array
    {
        return array_fill(0, 7, $this->createMock(ActivityDTO::class));
    }



    /**
     * @description 正常なインスタンス化をテストする
     * @return void
     */
    public function test_successful_instantiation()
    {
        $dto = new WeeklyActivityDTO($this->validDays(), $this->validActivities());
        $this->assertCount(7, $dto->days);
        $this->assertCount(7, $dto->activities);
    }

    /**
     * @description 日付の配列が7つでない場合に例外をスローすることをテストする
     * @return void
     */
    public function test_invalid_day_count_throws_exception()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The days array must contain exactly 7 elements.');

        new WeeklyActivityDTO(array_slice($this->validDays(), 0, 6), $this->validActivities());
    }

    public function test_invalid_day_format_throws_exception()
    {
        $invalidDays = $this->validDays();
        $invalidDays[3] = 'invalid-date';

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid date format in days array');

        new WeeklyActivityDTO($invalidDays, $this->validActivities());
    }

    public function test_invalid_activity_count_throws_exception()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The activities array must contain exactly 7 elements.');

        new WeeklyActivityDTO($this->validDays(), array_slice($this->validActivities(), 0, 6));
    }

    public function test_invalid_activity_type_throws_exception()
    {
        $invalidActivities = $this->validActivities();
        $invalidActivities[2] = new \stdClass(); // 不正な型

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('All elements in the activities array must be instances of ActivityDTO.');

        new WeeklyActivityDTO($this->validDays(), $invalidActivities);
    }
}
