<?php

namespace Tests\Unit\Services;

use App\Contract\TaskRepositoryInterface;
use App\Models\Task;
use App\Services\Task\TaskService;
use Illuminate\Pagination\LengthAwarePaginator;
use Tests\TestCase;

class TaskServiceTest extends TestCase
{
    protected $taskRepoMock;
    protected $userService;

    public function setUp(): void
    {
        parent::setUp();

        $this->taskRepoMock = $this->createMock(TaskRepositoryInterface::class);        
        $this->taskService = new TaskService($this->taskRepoMock);
    }

    public function testGetPaginated()
    {
        $relations = ['relation1', 'relation2'];

        $this->taskRepoMock->expects($this->once())->method('load')
            ->with($this->equalTo($relations))
            ->willReturn($this->taskRepoMock);

        $paginator =$this->createPaginationMock();    
        $this->taskRepoMock->method('getPaginated')
            ->with($this->equalTo(10))
            ->willReturn($paginator);         

        $result = $this->taskService->getPaginated(10, $relations); 
        $this->assertEquals($paginator, $result);
    }

    public function testTaskCreation()
    {
        $taskData = ['title' => 'unit test', 'description' => 'write unit test for this class', 'assigned_by_id' => 1, 'assigned_to_id' => 2];
        $task = new Task();
        $task->title = $taskData['title'];
        $task->description = $taskData['description'];
        $task->assigned_by_id = $taskData['assigned_by_id'];
        $task->assigned_to_id = $taskData['assigned_to_id'];

        $this->taskRepoMock->expects($this->once())->method('create')->willReturn($task);
        $taskModel = $this->taskService->create($taskData);
        $this->assertEquals($task, $taskModel);
    }

    private function createPaginationMock()
    {
        $items = collect([
            (object) ['id' => 1, 'name' => 'test1'],
            (object) ['id' => 2, 'name' => 'test2'],
        ]);

        $total = $items->count();
        $currentPage = 1;
        $perPage = 10;
        $paginator = new LengthAwarePaginator(
            $items->forPage($currentPage, $perPage),
            $total,
            $perPage,
            $currentPage,
        );

        return $paginator;
    }
}
