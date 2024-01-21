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

        Schema::create('daily_summary', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->float('total_upfront');
            $table->float('total_expense');
            $table->date('date');
            $table->string('type')->comment('gain/loss');
            $table->float('day_end_amount');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_summary');
    }
};
