<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Enums\TaskStatus;

/**
 * Class TaskController
 *
 * This controller handles the task-related operations.
 */
class TaskController extends Controller
{
    /**
     * @var TaskService
     * Service layer responsible for task business logic.
     */
    protected $taskService;
    use AuthorizesRequests;

    /**
     * TaskController constructor.
     *
     * @param TaskService $taskService
     * Injects the TaskService to handle business logic related to tasks.
     */
    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

     /**
     * Display a listing of all tasks.
     *
     * @return \Illuminate\Http\JsonResponse
     * Returns a JSON response containing all tasks with a 200 HTTP status code.
     */
    public function index()
    {
         $this->authorize('viewAny', Task::class);
        return response()->json($this->taskService->getAllTasks(), 200);
    }

    /**
     * Store a newly created task in the database.
     *
     * @param Request $request
     * The incoming request containing task data to be validated and stored.
     * 
     * @return \Illuminate\Http\JsonResponse
     * Returns a JSON response containing the newly created task with a 201 HTTP status code.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Task::class);
        $data = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:todo,in-progress,done',
        ]);

        return response()->json($this->taskService->createTask($data), 201);
    }

    /**
     * Display the specified task.
     *
     * @param int $id
     * The ID of the task to be fetched.
     * 
     * @return \Illuminate\Http\JsonResponse
     * Returns a JSON response containing the specified task with a 200 HTTP status code.
     */
    public function show($id)
    {
        $task = $this->taskService->getTaskById($id);
        $this->authorize('view', $task);
        return response()->json($this->taskService->getTaskById($id), 200);
    }

    /**
     * Update the specified task in the database.
     *
     * @param Request $request
     * @param int $id
     * 
     * @return \Illuminate\Http\JsonResponse
     * Returns a JSON response containing the updated task with a 200 HTTP status code.
     */
    public function update(Request $request)
    {
        $id = $request->input('id');
        $task = $this->taskService->getTaskById($id);
        $this->authorize('update', $task);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:'.implode(',', TaskStatus::all()),
        ]);

        return response()->json($this->taskService->updateTask($id, $data), 200);
    }

    /**
     * Remove the specified task from the database.
     *
     * @param Request $request
     * The ID of the task to be deleted.
     * 
     * @return \Illuminate\Http\JsonResponse
     * Returns a JSON response with a 204 HTTP status code indicating successful deletion.
     */
    public function destroy(Request $request)
    {
        $id = $request->input('id');
        $task = $this->taskService->getTaskById($id);
        $this->authorize('delete', $task);
        
        
        return response()->json($this->taskService->deleteTask($id), 200);
    }
}
