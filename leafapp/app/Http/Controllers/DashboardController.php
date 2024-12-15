<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Services\DashboardService;
class DashboardController extends Controller
{
    protected $service;

    public function __construct(DashboardService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $registerWordsCounts = $this->service->getResisterWordsCounts();
        $totalActivity = $this->service->getTotalActivitiy();
        $weeklyActivity = $this->service->getWeeklyActivity();
        return Inertia::render('User/Dashboard/Index',[
            "registerWordsCounts" => $registerWordsCounts,
            "totalActivity" => $totalActivity,
            "weeklyActivity" => $weeklyActivity
        ]);
    }
}