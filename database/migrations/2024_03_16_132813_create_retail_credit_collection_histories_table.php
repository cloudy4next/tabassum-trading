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
        Schema::create('retail_credit_collection_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('retail_id');
            $table->integer('prev_credit_amount');
            $table->integer('collection_amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retail_credit_collection_histories');
    }
};
