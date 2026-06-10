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
        Schema::create('donor_term_acceptances', function (Blueprint $table) {
            $table->id();

            $table->foreignId('donor_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->boolean('accepted')->default(true);

            $table->timestamp('accepted_at');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donor_term_acceptances');
    }
};
