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
        Schema::create('beneficiary_profiles', function (Blueprint $table) {
            $table->id();
              // 🔗 LINK TO USERS TABLE
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            // 📌 Profile Fields
            $table->string('institution')->nullable();

            $table->string('father_status')->nullable();

            $table->string('guardian_profession')->nullable();

            $table->decimal('monthly_income', 12, 2)->nullable();

            $table->string('province')->nullable();

            $table->string('domicile')->nullable();

            $table->text('home_address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beneficiary_profiles');
    }
};
