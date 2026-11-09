<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    if (!Schema::hasColumn('log_stok_obats', 'status')) {
        Schema::table('log_stok_obats', function (Blueprint $table) {
            $table->string('status')->nullable()->after('nilai');
        });
    }
}

    public function down(): void
    {
        Schema::table('log_stok_obats', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};