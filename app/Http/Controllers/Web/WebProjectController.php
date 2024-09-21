<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\ProjectService;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Project;
//use GuzzleHttp\Client;
use App\Http\Controllers\Api\ProjectController;


/**
 * Class ProjectController
 *
 * This controller handles the project-related operations.
 */
class WebProjectController extends Controller {

    /**
     * @var ProjectService
     * Service layer responsible for project business logic.
     */
    //protected $projectService;
    protected $apiProjectController;

    use AuthorizesRequests;

    /**
     * ProjectController constructor.
     *
     * @param TaskService $projectService
     * Injects the ProjectService to handle business logic related to projects.
     */
    public function __construct(ProjectController $apiProjectController) {
        $this->apiProjectController = $apiProjectController;
    }

    /**
     * Display a listing of all projects.
     * 
     * This method retrieves all projects using the API Project Controller,
     * decodes the JSON response into a PHP object, and then passes the 
     * projects data to the 'project.index' view for display.
     * @return \Illuminate\View\View The view displaying the list of projects.
     */
    public function index() {
        $projects = json_decode($this->apiProjectController->all()->content());
        //print_r($projects);die;
        $data = [
            'projects' => $projects
        ];

        return view('project.index', $data);
        //dd(session()->all());
    }

    /**
     * Create new project.
     *
     * @param Request $request
     * The incoming request containing project data to be validated and stored.
     * 
     * @return \Illuminate\View\View The view displaying add new project page.
     */
    public function store(Request $request) {
        $data = [
            'authToken' => session('authToken')->accessToken,
        ];

        return view('project.store', $data);
    }

    /**
     * Display the specified project.
     *
     * @param int $id
     * The ID of the project to be fetched.
     * 
     * @return \Illuminate\View\View The view displaying project by it's ID.
     */
    public function show($id) {
        //print_r($this->apiProjectController->show($id));die;
        $project = json_decode($this->apiProjectController->show($id)->content());
         $data = [
            'project' => $project
        ];

        return view('project.show', $data);
    }
    
    
    /**
     * Display the specified project with it's tasks.
     *
     * @param int $id
     * The ID of the project to be fetched.
     * 
     * @return \Illuminate\View\View The view displaying project with tasks by project's ID.
     */
    public function showWithTasks($id) {
        $project = json_decode($this->apiProjectController->showWithTasks($id)->content());
        
         $data = [
            'project' => $project
        ];

        return view('project.show', $data);
    }
    

    /**
     * Update the specified project.
     *
     * @param Request $request
     * @param int $id
     * 
     * @return \Illuminate\View\View The view displaying project to be updated.
     */
    public function update(Request $request, $id) {
       
         
        $project = json_decode($this->apiProjectController->show($id)->content());
         $data = [
            'project' => $project,
            'authToken' => session('authToken')->accessToken,
        ];

        return view('project.update', $data);
    }

    /**
     * Remove the specified project from the database.
     *
     * @param int $id
     * The ID of the project to be deleted.
     * 
     * @return \Illuminate\View\View The view displaying delete project page.
     */
    public function destroy($id) {
        $project = json_decode($this->apiProjectController->show($id)->content());
         $data = [
            'project' => $project,
            'authToken' => session('authToken')->accessToken,
        ];

        return view('project.destroy', $data);
    }
}
