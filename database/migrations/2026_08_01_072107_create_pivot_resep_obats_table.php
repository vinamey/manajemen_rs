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
        Schema::create('pivot_resep_obats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('resep_obat_id')->nullable();
            $table->foreign('resep_obat_id')->references('id')->on('resep_obats')->onDelete('set null');

            $table->foreignId('obat_id')->nullable();
            $table->foreign('obat_id')->references('id')->on('master_obats')->onDelete('set null');

            $table->foreignId('satuan_obat_id')->nullable();
            $table->foreign('satuan_obat_id')->references('id')->on('master_satuan_obats')->onDelete('set null');
            $table->integer('nilai');
            $table->string('aturan_pakai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivot_resep_obats');
    }
};
