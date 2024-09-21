<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ProjectService;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Project;


/**
 * Class ProjectController
 *
 * This controller handles the project-related operations.
 */
class ProjectController extends Controller {

    /**
     * @var ProjectService
     * Service layer responsible for project business logic.
     */
    protected $projectService;
    use AuthorizesRequests;

    /**
     * ProjectController constructor.
     *
     * @param TaskService $projectService
     * Injects the ProjectService to handle business logic related to projects.
     */
    public function __construct(ProjectService $projectService) {
        $this->projectService = $projectService;
    }

     /**
     * Display a listing of all projects.
     *
     * @return \Illuminate\Http\JsonResponse
     * Returns a JSON response containing all projects with a 200 HTTP status code.
     */
    public function all() {
        $this->authorize('viewAny', Project::class);
        return response()->json($this->projectService->getAllProjects(), 200);
    }

    /**
     * Store a newly created project in the database.
     *
     * @param Request $request
     * The incoming request containing project data to be validated and stored.
     * 
     * @return \Illuminate\Http\JsonResponse
     * Returns a JSON response containing the newly created project with a 201 HTTP status code.
     */
    public function store(Request $request) {
        $this->authorize('create', Project::class);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        return response()->json($this->projectService->createProject($data), 201);
    }

    /**
     * Display the specified project.
     *
     * @param int $id
     * The ID of the project to be fetched.
     * 
     * @return \Illuminate\Http\JsonResponse
     * Returns a JSON response containing the specified project with a 200 HTTP status code.
     */
    public function show($id) {
        $project = $this->projectService->getProjectById($id);
        $this->authorize('view', $project);
        return response()->json($this->projectService->getProjectById($id), 200);
    }
    
    /**
     * Display the specified project with it's tasks.
     *
     * @param int $id
     * The ID of the project to be fetched.
     * 
     * @return \Illuminate\Http\JsonResponse
     * Returns a JSON response containing the specified project with it's tasks with a 200 HTTP status code.
     */
    public function showWithTasks($id) {
        $project = $this->projectService->getProjectById($id);
        $this->authorize('view', $project);
        return response()->json($this->projectService->getProjectWithTasksById($id), 200);
    }

    /**
     * Update the specified project in the database.
     *
     * @param Request $request
     * 
     * @return \Illuminate\Http\JsonResponse
     * Returns a JSON response containing the updated project with a 200 HTTP status code.
     */
    public function update(Request $request) {
        $id = $request->input('id');
        $project = $this->projectService->getProjectById($id);
        $this->authorize('update', $project);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        return response()->json($this->projectService->updateProject($id, $data), 200);
    }

    /**
     * Remove the specified project from the database.
     *
     * @param Request $request
     * 
     * @return \Illuminate\Http\JsonResponse
     * Returns a JSON response with a 204 HTTP status code indicating successful deletion.
     */
    public function destroy(Request $request) {
        $id = $request->input('id');
        $project = $this->projectService->getProjectById($id);
        $this->authorize('delete', $project);
        
        return response()->json($this->projectService->deleteProject($id), 204);
    }
}
