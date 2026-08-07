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
    Schema::create('master_dokters', function (Blueprint $table) {
        $table->id();
        $table->string('nama')->nullable();
        $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
        $table->date('tanggal_lahir');
        $table->text('alamat')->nullable();
        $table->string('spesialis')->nullable();
        $table->foreignId('poli_id')->nullable();

        // Ubah 'master_polis' menjadi 'master_poli'
        $table->foreign('poli_id')->references('id')->on('master_poli')->onDelete('set null');

        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_dokters');
    }
};
