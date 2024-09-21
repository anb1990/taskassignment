<?php
namespace App\Services;

use App\Repositories\Interfaces\TaskRepositoryInterface;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use App\Services\LoggingService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

/**
 * Class TaskService
 *
 * Provides various services related to task.
 *
 * @package App\Services
 */
class TaskService
{
    /**
     * @var TaskRepositoryInterface
     */
    protected $taskRepository;
    protected $loggingService;

    /**
     * TaskService constructor.
     *
     * @param TaskRepositoryInterface $taskRepository
     */
    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * Find a task by its ID.
     *
     * @param int $id The ID of the task.
     * @return Task
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function getTaskById($id): Task
    {
        return $this->taskRepository->find($id);
    }
    /**
     * Get all tasks.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllTasks(): Collection
    {
        return $this->taskRepository->all();
    }

    

    /**
     * Create a new task.
     *
     * @param array $data
     * @return \App\Models\Task
     */
    public function createTask(array $data): Task
    {
        return $this->taskRepository->create($data);
    }

    /**
     * Update an existing task by its ID.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Task
     */
    public function updateTask($id, array $data): Task
    {
        return $this->taskRepository->update($id, $data);
    }

    /**
     * Delete a task by its ID.
     *
     * @param int $id
     * @return int
     */
    public function deleteTask(int $id): int
    {
        return $this->taskRepository->delete($id);
    }
}