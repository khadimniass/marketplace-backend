<?php

namespace Database\Factories;

use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'client_id' => User::where('role', 'client')->inRandomOrder()->first()->id, // Référence à un client
            'freelancer_id' => User::where('role', 'freelancer')->inRandomOrder()->first()->id, // Référence à un freelancer
            'service_id' => Service::inRandomOrder()->first()->id, // Référence à un service
            'total_price' => $this->faker->randomFloat(2, 10, 500), // Prix total de la commande entre 10 et 500
            'status' => $this->faker->randomElement(['pending', 'completed', 'canceled']), // Statut aléatoire
            'delivery_date' => $this->faker->dateTimeBetween('now', '+1 month'), // Date de livraison dans un mois maximum
        ];
    }
}
