<?php

namespace App\Repositories;

use App\Contract\TaskRepositoryInterface;
use App\Models\Task;

class TaskRepository implements TaskRepositoryInterface
{
    protected $model;   

    public function __construct(Task $model)
    {
        $this->model = $model;
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public  function getPaginated(int $paginationLimit = 10)
    {
        return $this->model->paginate($paginationLimit);
    }

    public function load(array $relations)
    {
        $this->model = $this->model->with($relations);
        return $this;
    }
}