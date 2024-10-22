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
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // id (Primary Key, Auto Increment)
            
            // Foreign Key a la tabla clients
            // $table->foreignId('client_id')
            //       ->constrained('clients')
            //       ->onDelete('cascade'); // Eliminar orden si el cliente es eliminado
            
            // // Foreign Key a la tabla branches
            // $table->foreignId('branch_id')
            //       ->constrained('branches')
            //       ->onDelete('cascade'); // Eliminar orden si la sucursal es eliminada
            
            // // Foreign Key opcional a la tabla employees para el delivery person
            // $table->foreignId('delivery_person_id')
            //       ->nullable()
            //       ->constrained('employees')
            //       ->onDelete('set null'); // Establecer a null si el empleado es eliminado
            
            // Campo total_price
            $table->decimal('total_price', 8, 2);
            
            // Campo enum para el status
            $table->enum('status', ['pendiente', 'en_preparacion', 'listo', 'entregado']);
            
            // Campo enum para el tipo de entrega
            $table->enum('delivery_type', ['en_local', 'a_domicilio']);
            
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
        Schema::dropIfExists('orders');
    }
};
