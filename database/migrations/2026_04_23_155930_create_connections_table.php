<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('connections', function (Blueprint $table) {
            $table->id();

        $table->foreignId('beneficiary_id')->constrained('users')->cascadeOnDelete();
        $table->foreignId('donor_id')->constrained('users')->cascadeOnDelete();

        $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');

        $table->timestamps();

        // ✅ ADD THIS LINE HERE
        $table->unique(['beneficiary_id', 'donor_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('connections');
    }
};