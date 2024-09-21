<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use App\Services\ProjectService;
use App\Http\Controllers\Api\ProjectController;
use Illuminate\Support\Facades\Auth;

class ProjectControllerTest extends TestCase {

    use RefreshDatabase;

    protected $projectService;
    protected $controller;

    protected function setUp(): void {
        parent::setUp();
        $this->projectService = $this->createMock(ProjectService::class);
        $this->controller = new ProjectController($this->projectService);
    }

    /** @test */
    public function it_can_return_all_projects() {
        $user = User::factory()->create();

        $this->actingAs($user);
        $projects = Project::factory()->count(3)->create();

        $this->projectService
                ->method('getAllProjects')
                ->willReturn($projects);

        $response = $this->controller->all();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJson($response->getContent());
        $this->assertCount(3, json_decode($response->getContent()));
    }
    
    

    /** @test */
    public function it_can_store_a_project() {
        $user = User::factory()->create();

        $this->actingAs($user);
        $data = [
            'name' => 'New Project',
            'description' => 'Project Description',
        ];

        $this->projectService
                ->method('createProject')
                ->willReturn(new Project($data));

        $request = Request::create('/projects', 'POST', $data);
        $response = $this->controller->store($request);

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertJson($response->getContent());
    }

    /** @test */
    public function it_can_show_a_project() {
        $project = Project::factory()->create();
        $user = User::factory()->create();

        $this->actingAs($user);
        $this->projectService
                ->method('getProjectById')
                ->with($project->id)
                ->willReturn($project);

        $response = $this->controller->show($project->id);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJson($response->getContent());
    }

    /** @test */
    public function it_can_update_a_project() {
        $project = Project::factory()->create();
        $user = User::factory()->create();

        $this->actingAs($user);
        $data = [
            'name' => 'Updated Project',
            'description' => 'Updated Description',
        ];

        $this->projectService
                ->method('updateProject')
                ->with($project->id, $data)
                ->willReturn(new Project($data));

        $request = Request::create('/projects', 'PUT', array_merge(['user_id' => $user->id, 'id' => $project->id], $data));
        $response = $this->controller->update($request);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJson($response->getContent());
    }

    /** @test */
    public function it_can_delete_a_project() {

        $project = Project::factory()->create();
        $user = User::factory()->create();

        $this->actingAs($user);
        $this->projectService
                ->method('deleteProject')
                ->with($project->id)
                ->willReturn(1);

        $request = Request::create('/projects', 'DELETE', ['id' => $project->id]);
        $response = $this->controller->destroy($request);

        $this->assertEquals(204, $response->getStatusCode());
    }
}
