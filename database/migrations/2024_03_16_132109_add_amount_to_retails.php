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
        Schema::table('retails', function (Blueprint $table) {
            $table->integer('amount')->after('company_id');
            $table->string('type')->after('amount');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('retails', function (Blueprint $table) {
            //
        });
    }
};
