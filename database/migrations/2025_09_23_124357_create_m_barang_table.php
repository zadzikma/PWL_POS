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

        Schema::create('m_barang', function (Blueprint $table) {
            $table->id('barang_id');
            $table->string('barang_kode');
            $table->string('barang_nama');
            $table->integer('harga_beli');
            $table->integer('harga_jual');

            // relasi
            $table->unsignedBigInteger('kategori_id');
            $table->foreign('kategori_id')->references('kategori_id')->on('m_kategori');

            $table->unsignedBigInteger('supplier_id');
            $table->foreign('supplier_id')->references('supplier_id')->on('m_supplier');

            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_barang');
    }
};
