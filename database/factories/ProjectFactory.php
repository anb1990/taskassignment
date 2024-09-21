<?php
namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Factory class for creating instances of Project model.
 *
 * This factory is used to generate dummy data for the Project model.
 *
 * @package Database\Factories
 */
class ProjectFactory extends Factory
{
     /**
     * The name of the model that this factory is for.
     *
     * @var string
     */
    protected $model = Project::class;

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
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
        ];
    }
}
