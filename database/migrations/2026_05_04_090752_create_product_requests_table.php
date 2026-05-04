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
        Schema::create('product_requests', function (Blueprint $table) {
            $table->id();
            // who is requesting (beneficiary)
            $table->foreignId('beneficiary_id')->constrained('users')->onDelete('cascade');

            // product requested
            $table->foreignId('product_id')->constrained()->onDelete('cascade');

            // donor (owner of product)
            $table->foreignId('donor_id')->constrained('users')->onDelete('cascade');

            // request status
            $table->enum('status', [
                'pending',          // waiting for admin
                'admin_approved',   // admin approved → visible to donor
                'admin_rejected',   // admin rejected → stop
                'accepted',         // donor accepted
                'rejected',          // donor rejected
            ])->default('pending');

            // optional message
            $table->text('message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_requests');
    }
};
