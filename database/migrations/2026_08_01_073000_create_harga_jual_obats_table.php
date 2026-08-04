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
        Schema::create('harga_jual_obats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('obat_id')->nullable();
            $table->foreign('obat_id')->references('id')->on('master_obats')->onDelete('set null');

            $table->foreignId('satuan_id')->nullable();
            $table->foreign('satuan_id')->references('id')->on('master_satuan_obats')->onDelete('set null');

            $table->integer('isi');
            $table->decimal('harga', 12, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('harga_jual_obats');
    }
};
