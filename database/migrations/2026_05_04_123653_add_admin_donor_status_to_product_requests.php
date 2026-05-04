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
       Schema::table('product_requests', function (Blueprint $table) {

            if (!Schema::hasColumn('product_requests', 'admin_status')) {
                $table->enum('admin_status', ['pending', 'approved', 'rejected'])
                      ->default('pending');
            }

            if (!Schema::hasColumn('product_requests', 'donor_status')) {
                $table->enum('donor_status', ['pending', 'accepted', 'rejected'])
                      ->default('pending');
            }

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_requests', function (Blueprint $table) {
              $table->dropColumn(['admin_status', 'donor_status']);
        });
    }
};
