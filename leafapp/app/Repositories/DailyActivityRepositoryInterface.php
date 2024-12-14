<?php

namespace App\Repositories;

interface DailyActivityRepositoryInterface
{
    public function get();
    public function register():void;
    public function delete():void;

}