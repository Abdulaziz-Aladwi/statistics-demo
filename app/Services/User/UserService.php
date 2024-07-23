<?php

namespace App\Services\User;

use App\Contract\UserRepositoryInterface;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Collection;

class UserService
{
    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllAdmins(array $selectedColumns): Collection
    {
        return $this->userRepository->allAdmins($selectedColumns);
    }
    
    public function getAllNormalUsers(array $selectedColumns): Collection
    {
        return $this->userRepository->allNormalUsers($selectedColumns);
    }
}