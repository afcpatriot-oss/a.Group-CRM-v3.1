<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasColumn('roles', 'role_orders')) {
            Schema::table('roles', function (Blueprint $table) {
                $table->integer('role_orders')->default(0);
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('roles', 'role_orders')) {
            Schema::table('roles', function (Blueprint $table) {
                $table->dropColumn('role_orders');
            });
        }
    }
};
