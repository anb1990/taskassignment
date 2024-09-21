<?php

namespace App\Repositories\Implementations;

use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Interfaces\ProjectRepositoryInterface;
use App\Services\LoggingService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

/**
 * Class ProjectRepository
 *
 * This class provides the implementation of the ProjectRepositoryInterface
 * for managing projects.
 *
 * @package App\Repositories\Implementations
 */
class ProjectRepository implements ProjectRepositoryInterface {

    protected $loggingService;

    public function __construct(LoggingService $loggingService)
    {
        $this->loggingService = $loggingService;
    }
    
    /**
     * Get all projects.
     *
     * @return \Illuminate\Database\Eloquent\Collection|Project[]
     */
    public function all(): Collection {
        try {
            return Project::all();
        } catch (Exception $e) {
            $this->loggingService->logError('Error fetching projects: ' . $e->getMessage());
            throw new Exception('Unable to fetch projects. Please try again later.');
        }
    }

    /**
     * Find a project by its ID.
     *
     * @param int $id The ID of the project.
     * @return Project
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function find(int $id): Project {
        try {
            return Project::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            $this->loggingService->logError('Project not found: ' . $e->getMessage());
            throw new Exception('Project not found.', 404);
        } catch (Exception $e) {
            $this->loggingService->logError('Error finding project: ' . $e->getMessage());
            throw new Exception('Unable to find project. Please try again later.');
        }
    }
    
    /**
     * Find a project with its tasks by project ID.
     *
     * @param int $id The ID of the project.
     * @return Project
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function findWithTasks(int $id): Project
    {
        try {
            return Project::with('tasks')->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            $this->loggingService->logError('Project with tasks not found: ' . $e->getMessage());
            throw new Exception('Project with tasks not found.', 404);
        } catch (Exception $e) {
            $this->loggingService->logError('Error finding project with tasks: ' . $e->getMessage());
            throw new Exception('Unable to find project with tasks. Please try again later.');
        }
    }

    /**
     * Create a new project.
     *
     * @param array $data The data to create the project.
     * @return Project
     */
    public function create(array $data): Project {
        try {
            return Project::create($data);
        } catch (Exception $e) {
            $this->loggingService->logError('Error creating project: ' . $e->getMessage());
            throw new Exception('Unable to create project. Please check your input and try again.');
        }
    }

    /**
     * Update an existing project by its ID.
     *
     * @param int $id The ID of the project.
     * @param array $data The data to update the project with.
     * @return Project
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function update(int $id, array $data): Project {
        try {
            $project = Project::findOrFail($id);
            $project->update($data);
            return $project;
        } catch (ModelNotFoundException $e) {
            $this->loggingService->logError('Project not found for update: ' . $e->getMessage());
            throw new Exception('Project not found for update.', 404);
        } catch (Exception $e) {
            $this->loggingService->logError('Error updating project: ' . $e->getMessage());
            throw new Exception('Unable to update project. Please check your input and try again.');
        }
    }

    /**
     * Delete a project by its ID.
     *
     * @param int $id The ID of the project.
     * @return int The number of rows deleted (1 if successful, 0 if not found).
     */
    public function delete(int $id): int {
        try {
            return Project::destroy($id);
        } catch (Exception $e) {
            $this->loggingService->logError('Error deleting project: ' . $e->getMessage());
            throw new Exception('Unable to delete project. Please try again later.');
        }
    }
}