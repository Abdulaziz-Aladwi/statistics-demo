<?php

namespace App\Contract;

interface TaskRepositoryInterface
{
    public function create(array $data);

    public function getPaginated(int $paginationLimit = 10);

    public function load(array $relations);
    
}
