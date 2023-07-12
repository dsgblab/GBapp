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
        Schema::create('design_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('priority_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('designer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('seller_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('customer_id')->constrained('users')->onDelete('cascade');
            $table->longText('comments')->nullable();
            $table->dateTime('reception_date')->nullable();
            $table->dateTime('tentative_date')->nullable();
            $table->dateTime('real_date')->nullable();
            $table->dateTime('delivery_date')->nullable();
            $table->dateTime('customer_approved_date')->nullable();
            $table->dateTime('estimated_arrival_sherpa_date')->nullable();
            $table->foreignId('time_state_id')->constrained('design_priorities')->onDelete('cascade');
            $table->foreignId('state_id')->constrained('design_states')->onDelete('cascade');
            $table->longText('observations')->nullable();
            $table->foreignId('created_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('updated_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('design_requests');
    }
};
