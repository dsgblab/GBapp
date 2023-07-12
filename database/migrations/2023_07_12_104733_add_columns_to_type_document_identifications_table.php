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
        Schema::table('type_document_identifications', function (Blueprint $table) {
            $table->foreignId('created_id')->nullable()->constrained('users');
            $table->foreignId('updated_id')->nullable()->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('type_document_identifications', function (Blueprint $table) {
            //
        });
    }
};
