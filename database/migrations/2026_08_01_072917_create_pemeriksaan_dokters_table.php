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
        Schema::create('pemeriksaan_dokters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_id')->nullable();
            $table->foreign('pendaftaran_id')->references('id')->on('pendaftaran_pasiens')->onDelete('set null');

            $table->foreignId('dokter_id')->nullable();
            $table->foreign('dokter_id')->references('id')->on('master_dokters')->onDelete('set null');

            $table->text('keluhan');
            $table->int('resep_obat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan_dokters');
    }
};
