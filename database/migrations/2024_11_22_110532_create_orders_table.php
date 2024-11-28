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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id'); // Référence au client
            $table->unsignedBigInteger('freelancer_id'); // Référence au freelancer
            $table->unsignedBigInteger('service_id'); // Référence au service acheté
            $table->decimal('total_price', 10, 2); // Prix total de la commande
            $table->string('status')->default('pending'); // pending, completed, canceled
            $table->timestamp('delivery_date')->nullable(); // Date de livraison prévue
            $table->timestamps();

            // Clés étrangères
            $table->foreign('client_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

            $table->foreign('freelancer_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('service_id')
                ->references('id')
                ->on('services')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
