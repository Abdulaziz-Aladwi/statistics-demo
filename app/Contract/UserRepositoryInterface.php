<?php

namespace App\Contract;

use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    public function allAdmins(array $selectedColumns = ['*']): Collection;
    public function allNormalUsers(array $selectedColumns = ['*']): Collection;
}
