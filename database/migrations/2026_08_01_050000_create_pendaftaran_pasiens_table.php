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
        Schema::create('pendaftaran_pasiens', function (Blueprint $table) {
            $table->id();
             $table->foreignId('pasien_id')->nullable();
            $table->foreign('pasien_id')->references('id')->on('master_pasiens')->onDelete('set null');

             $table->foreignId('dokter_id')->nullable();
            $table->foreign('dokter_id')->references('id')->on('master_dokters')->onDelete('set null');

             $table->foreignId('poli_id')->nullable();
            $table->foreign('poli_id')->references('id')->on('master_polis')->onDelete('set null');

             $table->foreignId('kamar_id')->nullable();
            $table->foreign('kamar_id')->references('id')->on('master_kamars')->onDelete('set null');

            $table->date('tanggal_pendaftaran');
            $table->string('nomor_antrian');
            $table->enum('status', ['menunggu', 'diperiksa', 'selesai']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_pasiens');
    }
};
