<?php

namespace App\Services\Statistics;

use App\Contract\StatisticsRepositoryInterface;
use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\Builder;

class StatisticsService
{
    protected StatisticsRepositoryInterface $statsRepository;

    public function __construct(StatisticsRepositoryInterface $statisticsRepository)
    {
        $this->statisticsRepository = $statisticsRepository;
    }

    public function getTopUsers(array $relation)
    {
        return $this->statisticsRepository->load($relation)->getTopUsers();
    }

    public function incrementUserTasksCount(User $user): void
    {
        $this->statisticsRepository->incrementCount($user);
    }
}