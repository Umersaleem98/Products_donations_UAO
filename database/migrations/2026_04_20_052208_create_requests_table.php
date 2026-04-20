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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
 $table->foreignId('product_id')->constrained()->cascadeOnDelete();
    $table->foreignId('donor_id')->constrained('users')->cascadeOnDelete();
    $table->foreignId('beneficiary_id')->constrained('users')->cascadeOnDelete();

    $table->enum('status', ['pending','accepted','rejected'])->default('pending');
    $table->text('message')->nullable();

    $table->timestamps();

    $table->unique(['product_id','beneficiary_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
