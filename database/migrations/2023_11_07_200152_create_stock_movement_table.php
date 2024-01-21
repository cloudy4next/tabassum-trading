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
        Schema::disableForeignKeyConstraints();

        Schema::create('stock_movement', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id');
            $table->date('date');
            $table->integer('opening_stock');
            $table->integer('quantity_in');
            $table->integer('quantity_out');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_movement');
    }
};
