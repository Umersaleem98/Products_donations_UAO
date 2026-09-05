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

            /*
            |--------------------------------------------------------------------------
            | User Relationship
            |--------------------------------------------------------------------------
            */

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Personal Information
            |--------------------------------------------------------------------------
            */

            $table->enum('gender', [
                'male',
                'female',
                'other'
            ])->nullable();

            /*
            |--------------------------------------------------------------------------
            | Academic Information
            |--------------------------------------------------------------------------
            */

            $table->string('institution')->nullable();

            $table->enum('degree_level', [
                'UG',
                'PG',
                'PhD'
            ])->nullable();

            $table->string('degree_program')->nullable();

            $table->string('department')->nullable();

            $table->string('semester')->nullable();

            $table->decimal('cgpa', 4, 2)->nullable();

            $table->year('enrollment_year')->nullable();

            $table->year('graduation_year')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Family / Guardian Information
            |--------------------------------------------------------------------------
            */

            $table->string('father_status')->nullable();

            $table->string('guardian_profession')->nullable();

            $table->decimal('monthly_income', 12, 2)->nullable();

            /*
            |--------------------------------------------------------------------------
            | Location Information
            |--------------------------------------------------------------------------
            */

            $table->string('province')->nullable();

            $table->string('domicile')->nullable();

            $table->text('home_address')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Timestamps
            |--------------------------------------------------------------------------
            */

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