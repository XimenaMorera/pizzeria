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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id(); // id (Primary Key, Auto Increment)
            
            // Foreign Key a la tabla suppliers
            $table->foreignId('supplier_id')
                  ->constrained('suppliers')
                  ->onDelete('cascade'); // Eliminar compra si el proveedor es eliminado
            
            // Foreign Key a la tabla raw_materials
            $table->foreignId('raw_material_id')
                  ->constrained('raw_materials')
                  ->onDelete('cascade'); // Eliminar compra si el material crudo es eliminado
            
            $table->decimal('quantity', 8, 2); // quantity (Decimal, 8, 2)
            $table->decimal('purchase_price', 8, 2); // purchase_price (Decimal, 8, 2)
            $table->timestamp('purchase_date'); // purchase_date (Timestamp)
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
        Schema::dropIfExists('purchases');
    }
};
