<?php

namespace App\Repositories;

use App\Contract\StatisticsRepositoryInterface;
use App\Models\Statistic;
use App\Models\User;

class StatisticsRepository implements StatisticsRepositoryInterface
{
    protected $model;   

    public function __construct(Statistic $model)
    {
        $this->model = $model;
    }

    public function incrementCount(User $user): void
    {
        $user->statistic()->firstOrCreate();
        $user->statistic->update(['tasks_count' => $user->Statistic->tasks_count + 1]);
    }

    public function getTopUsers(int $limit = 10)
    {
        return $this->model->orderBy('tasks_count', 'DESC')->take($limit)->get();
    }

    public function load(array $relations)
    {
        $this->model = $this->model->with($relations);
        return $this;
    }
}