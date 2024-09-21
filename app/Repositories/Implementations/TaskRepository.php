<?php
namespace App\Repositories\Implementations;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Interfaces\TaskRepositoryInterface;
use App\Services\LoggingService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

/**
 * Class TaskRepository
 *
 * This class provides the implementation of the TaskRepositoryInterface
 * for managing tasks.
 *
 * @package App\Repositories\Implementations
 */
class TaskRepository implements TaskRepositoryInterface
{
    protected $loggingService;

    public function __construct(LoggingService $loggingService)
    {
        $this->loggingService = $loggingService;
    }

    /**
     * Get all tasks.
     *
     * @return \Illuminate\Database\Eloquent\Collection|Task[]
     */
    public function all(): Collection
    {
        try {
            return Task::all();
        } catch (Exception $e) {
            $this->loggingService->logError('Error fetching tasks: ' . $e->getMessage());
            throw new Exception('Unable to fetch tasks. Please try again later.');
        }
    }

    /**
     * Find a task by its ID.
     *
     * @param int $id The ID of the task.
     * @return Task
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function find(int $id): Task
    {
        try {
            return Task::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            $this->loggingService->logError('Task not found: ' . $e->getMessage());
            throw new Exception('Task not found.', 404);
        } catch (Exception $e) {
            $this->loggingService->logError('Error finding task: ' . $e->getMessage());
            throw new Exception('Unable to find task. Please try again later.');
        }
    }

    /**
     * Create a new task.
     *
     * @param array $data The data to create the task.
     * @return Task
     */
    public function create(array $data): Task
    {
        try {
            return Task::create($data);
        } catch (Exception $e) {
            $this->loggingService->logError('Error creating task: ' . $e->getMessage());
            throw new Exception('Unable to create task. Please check your input and try again.');
        }
    }

    /**
     * Update an existing task by its ID.
     *
     * @param int $id The ID of the task.
     * @param array $data The data to update the task with.
     * @return Task
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function update(int $id, array $data): Task
    {
        try {
            $task = Task::findOrFail($id);
            $task->update($data);
            return $task;
        } catch (ModelNotFoundException $e) {
            $this->loggingService->logError('Task not found for update: ' . $e->getMessage());
            throw new Exception('Task not found for update.', 404);
        } catch (Exception $e) {
            $this->loggingService->logError('Error updating task: ' . $e->getMessage());
            throw new Exception('Unable to update task. Please check your input and try again.');
        }
    }

    /**
     * Delete a task by its ID.
     *
     * @param int $id The ID of the task.
     * @return int The number of rows deleted (1 if successful, 0 if not found).
     */
    public function delete(int $id): int
    {
        try {
            return Task::destroy($id);
        } catch (Exception $e) {
            $this->loggingService->logError('Error deleting task: ' . $e->getMessage());
            throw new Exception('Unable to delete task. Please try again later.');
        }
    }
}