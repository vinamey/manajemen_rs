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
        Schema::create('pembelian_obats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->nullable();
            $table->foreign('supplier_id')->references('id')->on('master_suppliers')->onDelete('set null');
            $table->integer('obat_id');
            $table->foreignId('satuan_id')->nullable();
            $table->foreign('satuan_id')->references('id')->on('master_satuan_obats')->onDelete('set null');
            $table->integer('nilai');
            $table->date('tanggal');
            $table->integer('apoteker_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembelian_obats');
    }
};
