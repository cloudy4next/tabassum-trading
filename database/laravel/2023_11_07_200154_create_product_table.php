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

        Schema::create('product', function (Blueprint $table) {
            $table->id()->foreign('stock_movement.product_id');
            $table->string('name');
            $table->bigInteger('barcode');
            $table->integer('dp');
            $table->integer('rp');
            $table->bigInteger('upfront');
            $table->integer('initial_stock');
            $table->bigInteger('current_stock');
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('company');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
