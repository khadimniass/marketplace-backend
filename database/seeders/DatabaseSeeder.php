<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Order;
use App\Models\Project;
use App\Models\Review;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(50)->create();
        Category::factory(5)->create(); // Développement Web, Graphisme, Rédaction.
        Service::factory(10)->create();
        Order::factory(50)->create();  // order = commandes
        Project::factory(80)->create();
        Review::factory(30)->create();
    }
}
