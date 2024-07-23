<?php

namespace Tests\Unit\Services;

use App\Constants\UserType;
use App\Contract\UserRepositoryInterface;
use App\Services\User\UserService;
use Illuminate\Database\Eloquent\Collection;
use Mockery;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    protected $userRepoMock;
    protected $userService;

    public function setUp(): void
    {
        parent::setUp();

        $this->userRepoMock = $this->createMock(UserRepositoryInterface::class);        
        $this->userService = new UserService($this->userRepoMock);
    }

    public function testGetAllAdmins()
    {
        $mockedAdminUsers = new Collection([
            (object) ['id' => 1, 'name' => 'test1', 'type' => UserType::TYPE_ADMIN],
            (object) ['id' => 2, 'name' => 'test2',  'type' => UserType::TYPE_ADMIN],
        ]);

        $this->userRepoMock->expects($this->once())->method('allAdmins')->willReturn($mockedAdminUsers);
        
        $adminItems = $this->userService->getAllAdmins(['id', 'name']);
        $this->assertEquals($adminItems, $mockedAdminUsers);    
    }
}
