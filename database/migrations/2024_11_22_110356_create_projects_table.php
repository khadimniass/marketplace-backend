<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Référence au client
            $table->unsignedBigInteger('category_id'); // Référence à la catégorie
            $table->string('title');
            $table->text('description');
            $table->decimal('budget', 10, 2); // Budget prévu
            $table->string('deadline')->nullable(); // Date limite pour le projet
            $table->string('status')->default('open'); // open, in-progress, completed, canceled
            $table->timestamps();

            // Clés étrangères
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
