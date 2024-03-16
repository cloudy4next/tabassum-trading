<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
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
            $table->integer('stock');
            $table->string('type')->default('sale_out');
            $table->integer('monthly_opening_stock')->comment('will be calculated from the previous month closing stock');
            $table->integer('daily_opening_stock')->comment('will be calculated from the previous day closing stock');
            $table->integer('quantity_in')->comment('day received');
            $table->integer('total_received')->comment('from the beginning of the month');
            $table->integer('quantity_out')->comment('day sold');
            $table->integer('total_sold')->comment('from the beginning of the month');
            $table->integer('daily_closing_stock')->comment('will be calculated from the daily opening stock + quantity_in - quantity_out');
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
