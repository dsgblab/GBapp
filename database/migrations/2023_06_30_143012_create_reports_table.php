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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('groupId');
            $table->string('reportId');
            $table->string('accessLevel');
            $table->string('datasetId');
            $table->unique(['groupId', 'reportId', 'datasetId'], 'report_unique_group_report_fk');
            $table->foreignId('user_id')->constrained('users');
            $table->string('permission')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
