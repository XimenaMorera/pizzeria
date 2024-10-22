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
        Schema::create('employees', function (Blueprint $table) {
            $table->id(); // id (Primary Key, Auto Increment)
            $table->foreignId('user_id') // user_id (Foreign Key, referencia a users.id)
                  ->constrained('users')
                  ->onDelete('cascade'); // Cascada al eliminar usuario
            $table->enum('position', ['cajero', 'administrador', 'cocinero', 'mensajero']); // Enum con posiciones
            $table->string('identification_number'); // identification_number (String, 20)
            $table->integer('salary'); // salary (Decimal, 8, 2)
            $table->date('hire_date'); // hire_date (Date)
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
        Schema::dropIfExists('employees');
    }
};
