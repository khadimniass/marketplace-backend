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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_id'); // Référence au service
            $table->unsignedBigInteger('client_id'); // Référence au client
            $table->integer('rating')->default(1); // Note de 1 à 5
            $table->text('comment')->nullable(); // Commentaire du client
            $table->timestamps();

            // Clés étrangères
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
