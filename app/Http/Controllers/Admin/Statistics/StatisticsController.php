<?php

namespace App\Http\Controllers\Admin\Statistics;

use App\Http\Controllers\Controller;
use App\Services\Statistics\StatisticsService;

class StatisticsController extends Controller
{
    protected StatisticsService $statisticsService;

    public function __construct(StatisticsService $statisticsService)
    {
        $this->statisticsService = $statisticsService;
    }

    public function index()
    {
        $topUsers = $this->statisticsService->getTopUsers(['assignee:id,name']);

        return view('admin.statistics.index', [
            'title' => 'Statistics',
            'statistics' => $topUsers
        ]);
    }
}
