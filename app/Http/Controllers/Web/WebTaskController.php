<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\TaskService;
use Illuminate\Http\Request;
use App\Enums\TaskStatus;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Controllers\Api\TaskController;

/**
 * Class TaskController
 *
 * This controller handles the task-related operations.
 */
class WebTaskController extends Controller
{
    /**
     * @var TaskService
     * Service layer responsible for task business logic.
     */
    protected $apiTaskController;

    use AuthorizesRequests;

    /**
     * TaskController constructor.
     *
     * @param TaskService $taskService
     * Injects the TaskService to handle business logic related to tasks.
     */
    public function __construct(TaskController $apiTaskController) {
        $this->apiTaskController = $apiTaskController;
    }

     

    /**
     * Create new task.
     *
     * @param Request $request
     * The incoming request containing task data to be validated and stored.
     * 
     * @return \Illuminate\View\View The view displaying add new task page.
     */
    public function store(Request $request, $projectId)
    {
        $taskStatusOptions = TaskStatus::all();
        $data = [
            'authToken' => session('authToken')->accessToken,
            'taskStatusOptions' => $taskStatusOptions,
            'projectId' => $projectId,
        ];

        return view('task.store', $data);
    }

   

    /**
     * Update the specified task.
     *
     * @param Request $request
     * @param int $id
     * 
     * @return \Illuminate\View\View The view displaying task to be updated.
     */
    public function update(Request $request, $id)
    {
        $task = json_decode($this->apiTaskController->show($id)->content());
         $taskStatusOptions = TaskStatus::all();
        $data = [
            'task' => $task,
            'authToken' => session('authToken')->accessToken,
            'taskStatusOptions' => $taskStatusOptions,
        ];
        
        return view('task.update', $data);
    }

    /**
     * Remove the specified task from the database.
     *
     * @param int $id
     * The ID of the task to be deleted.
     * 
     * @return \Illuminate\View\View The view displaying delete task page.
     */
    public function destroy($id)
    {
        $task = json_decode($this->apiTaskController->show($id)->content());
         $data = [
            'task' => $task,
            'authToken' => session('authToken')->accessToken,
        ];

        return view('task.destroy', $data);
    }
}
