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
        Schema::create('report_filters', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('table');
            $table->string('column');
            $table->string('operator');
            $table->string('values');
            $table->unique(['table', 'column', 'operator']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_filters');
    }
};
