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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');             // Ex: Ryzen 5 5600 ou RX 9070 XT
            $table->string('brand')->nullable(); // Ex: AMD, Intel, NVIDIA
            $table->string('category');          // Ex: CPU, GPU, RAM
            $table->decimal('price', 10, 2);     // Preço do componente
            $table->string('image')->nullable(); // Caminho para a imagem (ex: 'gpu_rx9070.jpg')

            // Campo JSON para guardar as specs técnicas do dataset do GitHub
            $table->json('specifications')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
