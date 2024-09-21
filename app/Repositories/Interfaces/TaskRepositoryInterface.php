<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Task;


interface TaskRepositoryInterface {

    public function all(): Collection;
    
    public function find(int $id): Task;
    
    public function create(array $data): Task;

    public function update(int $id, array $data): Task;

    public function delete(int $id): int;
}
