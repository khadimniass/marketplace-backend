<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::where('role', 'client')->inRandomOrder()->first()->id, // Référence à un client
            'category_id' => Category::inRandomOrder()->first()->id, // Référence à une catégorie
            'title' => $this->faker->word(), // Titre du projet
            'description' => $this->faker->paragraph(), // Description du projet
            'budget' => $this->faker->randomFloat(2, 50, 10000), // Budget aléatoire entre 50 et 10 000
            'deadline' => $this->faker->optional()->date(), // Date limite facultative
            'status' => $this->faker->randomElement(['open', 'in-progress', 'completed', 'canceled']), // Statut du projet
        ];
    }
}
