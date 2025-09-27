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
        Schema::create('t_penjualan_detail', function (Blueprint $table) {
            $table->id('detail_id');
            $table->integer('jumlah');
            $table->integer('harga');

            // relasi ke t_penjualan
            $table->unsignedBigInteger('penjualan_id');
            $table->foreign('penjualan_id')->references('penjualan_id')->on('t_penjualan');

            // relasi ke m_barang
            $table->unsignedBigInteger('barang_id');
            $table->foreign('barang_id')->references('barang_id')->on('m_barang');

            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_penjualan_detail');
    }
};
