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
        Schema::create('hasil_pemeriksaans', function (Blueprint $table) {
            $table->id();
             $table->foreignId('pemeriksaan_id')->nullable();
            $table->foreign('pemeriksaan_id')->references('id')->on('pemeriksaan_dokters')->onDelete('set null');
            $table->date('tanggal_pemeriksaan');
            $table->text('keluhan');
            $table->text('diagnosa');
            $table->text('diagnosa');

            $table->foreignId('tindakan_id')->nullable();
            $table->foreign('tindakan_id')->references('id')->on('master_tindakans')->onDelete('set null');

            $table->decimal('suhu_tubuh', 4, 1); 
            $table->decimal('berat_badan', 5, 2);
            $table->decimal('tinggi_badan', 5, 2);
            $table->text('catatan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_pemeriksaans');
    }
};
