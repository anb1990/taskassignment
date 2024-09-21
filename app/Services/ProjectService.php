<?php

namespace App\Services;

use App\Repositories\Interfaces\ProjectRepositoryInterface;
use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;
use App\Services\LoggingService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

/**
 * Class ProjectService
 *
 * Provides various services related to project.
 *
 * @package App\Services
 */
class ProjectService
{
    /**
     * @var ProjectRepositoryInterface
     */
    protected $projectRepository;
    protected $loggingService;

    /**
     * ProjectService constructor.
     *
     * @param ProjectRepositoryInterface $projectRepository
     * @param LoggingService $loggingService
     */
    public function __construct(ProjectRepositoryInterface $projectRepository, LoggingService $loggingService)
    {
        $this->projectRepository = $projectRepository;
        $this->loggingService = $loggingService;
    }

    /**
     * Get all projects.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllProjects(): Collection
    {
        try {
            return $this->projectRepository->all();
        } catch (Exception $e) {
            $this->loggingService->logError('Error fetching all projects: ' . $e->getMessage());
            throw new Exception('Unable to fetch projects. Please try again later.');
        }
    }

    /**
     * Get a project by its ID.
     *
     * @param int $id
     * @return \App\Models\Project
     * 
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function getProjectById(int $id): Project
    {
        try {
            return $this->projectRepository->find($id);
        } catch (ModelNotFoundException $e) {
            $this->loggingService->logError('Project not found: ' . $e->getMessage());
            throw new Exception('Project not found.', 404);
        } catch (Exception $e) {
            $this->loggingService->logError('Error finding project: ' . $e->getMessage());
            throw new Exception('Unable to find project. Please try again later.');
        }
    }
    
    /**
     * Get a project with its tasks by its ID.
     *
     * @param int $id
     * @return \App\Models\Project
     * 
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function getProjectWithTasksById(int $id): Project
    {
        try {
            return $this->projectRepository->findWithTasks($id);
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
     * @param array $data
     * @return \App\Models\Project
     */
    public function createProject(array $data): Project
    {
        try {
            return $this->projectRepository->create($data);
        } catch (Exception $e) {
            $this->loggingService->logError('Error creating project: ' . $e->getMessage());
            throw new Exception('Unable to create project. Please check your input and try again.');
        }
    }

    /**
     * Update an existing project by its ID.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Project
     */
    public function updateProject(int $id, array $data): Project
    {
        try {
            return $this->projectRepository->update($id, $data);
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
     * @param int $id
     * @return int
     */
    public function deleteProject(int $id): int
    {
        try {
            return $this->projectRepository->delete($id);
        } catch (Exception $e) {
            $this->loggingService->logError('Error deleting project: ' . $e->getMessage());
            throw new Exception('Unable to delete project. Please try again later.');
        }
    }
}