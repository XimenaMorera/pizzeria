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
        Schema::create('raw_materials', function (Blueprint $table) {
            $table->id(); // id (Primary Key, Auto Increment)
            $table->string('name', 255); // name (String, 255)
            $table->string('unit', 50); // unit (String, 50)
            $table->decimal('current_stock', 8, 2); // current_stock (Decimal, 8, 2)
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
        Schema::dropIfExists('raw_materials');
    }
};
