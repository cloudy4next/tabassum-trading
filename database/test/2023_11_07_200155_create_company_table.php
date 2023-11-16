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

        Schema::create('company', function (Blueprint $table) {
            $table->id()->foreign('daily_summary.company_id');
            $table->bigInteger('name');
            $table->bigInteger('initial_balance');
            $table->bigInteger('bank_id');
            $table->foreign('bank_id')->references('id')->on('bank');
            $table->float('current_balance');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company');
    }
};
