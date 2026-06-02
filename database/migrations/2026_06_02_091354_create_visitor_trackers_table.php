<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visitor_trackers', function (Blueprint $table) {

            $table->id();

            $table->string('ip_address')->index();
            $table->text('user_agent')->nullable();

            $table->string('browser')->nullable()->index();
            $table->string('platform')->nullable()->index();

            $table->boolean('cookie_accepted')->default(false);

            $table->timestamp('visited_at')->nullable()->index();

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visitor_trackers');
    }
};