<?php

namespace App\Repositories;

use App\Constants\UserType;
use App\Contract\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function allAdmins(array $selectedColumns = ['*']): Collection
    {
        return $this->model->select($selectedColumns)->OfType(UserType::TYPE_ADMIN)->get();
    }

    public function allNormalUsers(array $selectedColumns = ['*']): Collection
    {
        return $this->model->select($selectedColumns)->OfType(UserType::TYPE_NORMAL)->get();
    }
}
