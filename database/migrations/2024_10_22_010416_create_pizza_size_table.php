<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pizza_size', function (Blueprint $table) {
            $table->id(); // id (Primary Key, Auto Increment)
            
            // FK a la tabla pizzas
            $table->foreignId('pizza_id')
                  ->constrained('pizzas')
                  ->onDelete('cascade'); // Eliminar tamaño si la pizza es eliminada
            
            // Campo Enum para el tamaño
            $table->enum('size', ['pequeña', 'mediana', 'grande']);
            
            // Campo decimal para el precio
            $table->decimal('price', 8, 2);
            
            $table->timestamps(); // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pizza_size');
    }
};
