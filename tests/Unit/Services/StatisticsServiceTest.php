<?php

namespace Tests\Unit\Services;

use App\Constants\UserType;
use App\Contract\StatisticsRepositoryInterface;
use App\Contract\UserRepositoryInterface;
use App\Services\Statistics\StatisticsService;
use App\Services\User\UserService;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;

class StatisticsServiceTest extends TestCase
{
    protected $statisticsRepoMock;
    protected $statisticsService;

    public function setUp(): void
    {
        parent::setUp();

        $this->statisticsRepoMock = $this->createMock(StatisticsRepositoryInterface::class);        
        $this->statisticsService = new StatisticsService($this->statisticsRepoMock);
    }

    public function testGetTopUsers()
    {      
        $relations = ['relation1:id,name'];

        $this->statisticsRepoMock->expects($this->once())->method('load')
            ->with($relations)
            ->willReturn($this->statisticsRepoMock);
            
        $expected = new Collection([
            (object) ['id' => 1, 'assigned_to_id' => 1, 'tasks_count' => 5],
            (object) ['id' => 2, 'assigned_to_id' => 2, 'tasks_count' => 4],
        ]);

        $this->statisticsRepoMock->expects($this->once())->method('getTopUsers')->willReturn($expected);
        $actual = $this->statisticsService->getTopUsers($relations);
        $this->assertEquals($expected, $actual);
    }
}
