<?php

namespace App\Services\Task;

use App\Contract\TaskRepositoryInterface;
use App\Jobs\Admin\Statistics\IncrementUserTasksCount;
use App\Models\Task;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class TaskService
{
    protected TaskRepositoryInterface $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function getPaginated(int $paginationLimit, array $relations): LengthAwarePaginator
    {
        return $this->taskRepository->load($relations)->getPaginated($paginationLimit);
    }

    public function create(array $taskData): Task
    {
       return $this->taskRepository->create($taskData);
    }

    public function updateUserTasksCount(User $user): void
    {
        dispatch(new IncrementUserTasksCount($user));
    }
}