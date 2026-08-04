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
        Schema::create('master_pasiens', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable;
            $table->enum('jenis_kelamin',['laki-laki', 'perempuan']);
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->enum('status_asuransi', ['01', '0']);
            $table->enum('golongan_darah', ['A', 'B', 'AB', 'O']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_pasiens');
    }
};
