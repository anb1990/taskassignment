<?php
namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Project;
use App\Enums\TaskStatus;

/**
 * Factory class for creating instances of Task model.
 *
 * This factory is used to generate dummy data for the Task model.
 *
 * @package Database\Factories
 */
class TaskFactory extends Factory
{
    /**
     * The name of the model that this factory is for.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * This method returns an array of default values using Faker for the Project models
     * attributes.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'project_id' => Project::factory(),
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'status' => $this->faker->randomElement(TaskStatus::all()),
        ];
    }
}
