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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id') // user_id (Foreign Key, referencia a users.id)
            ->constrained('users') ->onDelete('cascade'); // Si el usuario es eliminado, se elimina el cliente también
             $table->string('address')->nullable(); // address (String, 255, Nullable)
             $table->string('phone')->nullable(); // phone (String, 20, Nullable)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
};
