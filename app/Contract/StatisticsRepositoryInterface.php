<?php

namespace App\Contract;

use App\Models\User;

interface StatisticsRepositoryInterface
{
    public function incrementCount(User $user);
    public function getTopUsers(int $limit = 10);
    public function load(array $relations);
}
