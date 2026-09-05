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
        Schema::create('log_stok_obats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('obat_id')->nullable();
            $table->foreign('obat_id')->references('id')->on('master_obats')->onDelete('set null');

            $table->integer('nilai')->nullable;
            $table->foreignId('stok_obat_id')->nullable();
            $table->foreign('stok_obat_id')->references('id')->on('stok_obats')->onDelete('set null');

            $table->date('tanggal_update');
            $table->integer('pivot_resep_obat_id')->nullable();

            $table->foreignId('pembelian_obat_id')->nullable();
            $table->foreign('pembelian_obat_id')->references('id')->on('pembelian_obats')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_stok_obats');
    }
};
