<?php

namespace App\Repositories;
use Carbon\Carbon;
interface DailyActivityRepositoryInterface
{
    public function get();
    public function getRegisterByDate(Carbon $date);
    public function getDeleteByDate(Carbon $date);
    public function register():void;
    public function delete():void;

}