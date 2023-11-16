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

        Schema::create('retail_sales_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('retail_id');
            $table->foreign('retail_id')->references('id')->on('retails');
            $table->unsignedBigInteger('sales_id');
            $table->date('sales_date');
            $table->unsignedInteger('amount');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retail_sales_history');
    }
};
