<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('password123'), // Mot de passe par défaut
            'role' => $this->faker->randomElement(['freelancer', 'client']),
            'profile_picture' => $this->faker->imageUrl(400, 400, 'people', true, 'profile'), // URL d'image générée
            'bio' => $this->faker->optional()->sentence(), // Une bio aléatoire ou null
            'skills' => $this->faker->optional()->words(3, true), // Liste de 3 compétences séparées par des espaces
            'phone' => $this->faker->optional()->phoneNumber(),
            'location' => $this->faker->optional()->city(),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
