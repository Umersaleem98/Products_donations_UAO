<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('account_status', [
                'active',
                'suspended',
                'blocked',
            ])
                ->default('active')
                ->after('role');

            $table->text('status_reason')
                ->nullable()
                ->after('account_status');

            $table->timestamp('status_changed_at')
                ->nullable()
                ->after('status_reason');

            $table->foreignId('status_changed_by')
                ->nullable()
                ->after('status_changed_at')
                ->constrained('users')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign([
                'status_changed_by',
            ]);

            $table->dropColumn([
                'account_status',
                'status_reason',
                'status_changed_at',
                'status_changed_by',
            ]);
        });
    }
};
