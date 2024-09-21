<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Project;

interface ProjectRepositoryInterface {

    public function all(): Collection;

    public function find(int $id): Project;
    
    public function findWithTasks(int $id): Project;

    public function create(array $data): Project;

    public function update(int $id, array $data): Project;

    public function delete(int $id): int;
}
