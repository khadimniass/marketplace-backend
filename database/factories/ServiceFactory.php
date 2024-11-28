<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id, // Associe un utilisateur aléatoire
            'category_id' => Category::inRandomOrder()->first()->id, // Associe une catégorie aléatoire
            'title' => $this->faker->sentence(4), // Titre du service
            'description' => $this->faker->paragraph(3), // Description du service
            'price' => $this->faker->randomFloat(2, 5, 500), // Prix entre 5 et 500
            'delivery_time' => $this->faker->randomElement(['1 jour', '2 jours', '3 jours', '1 semaine']), // Temps de livraison aléatoire
            'status' => $this->faker->randomElement(['active', 'inactive', 'archive']), // Statut aléatoire
        ];
    }
}
