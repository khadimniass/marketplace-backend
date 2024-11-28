<?php

namespace Database\Factories;

use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'service_id' => Service::inRandomOrder()->first()->id, // Référence aléatoire à un service
            'client_id' => User::where('role', 'client')->inRandomOrder()->first()->id, // Référence à un client
            'rating' => $this->faker->numberBetween(1, 5), // Note aléatoire entre 1 et 5
            'comment' => $this->faker->optional()->paragraph(), // Commentaire facultatif
        ];
    }
}
