<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
       $data = [
            // Supplier 1 (PT. Makmur Jaya)
            ['barang_id' => 1, 'barang_kode' => 'BRG001', 'barang_nama' => 'Mie Instan Rasa Ayam Bawang',
             'harga_beli' => 2000, 'harga_jual' => 2500, 'kategori_id' => 1, 'supplier_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['barang_id' => 2, 'barang_kode' => 'BRG002', 'barang_nama' => 'Biskuit Roma Kelapa',
             'harga_beli' => 8500, 'harga_jual' => 10000, 'kategori_id' => 1, 'supplier_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['barang_id' => 3, 'barang_kode' => 'BRG003', 'barang_nama' => 'Susu Kotak Ultra Milk',
             'harga_beli' => 4500, 'harga_jual' => 5500, 'kategori_id' => 2, 'supplier_id' => 1, 'created_at' => now(), 'updated_at' => now()],

            // Supplier 2 (PT. Wings)
            ['barang_id' => 4, 'barang_kode' => 'BRG004', 'barang_nama' => 'Air Mineral Aqua Botol',
             'harga_beli' => 2800, 'harga_jual' => 3500, 'kategori_id' => 2, 'supplier_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['barang_id' => 5, 'barang_kode' => 'BRG005', 'barang_nama' => 'Gula Pasir Kemasan 1 kg',
             'harga_beli' => 12500, 'harga_jual' => 14000, 'kategori_id' => 1, 'supplier_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['barang_id' => 6, 'barang_kode' => 'BRG006', 'barang_nama' => 'Sabun Cuci Piring Sunlight',
             'harga_beli' => 15000, 'harga_jual' => 18000, 'kategori_id' => 3, 'supplier_id' => 2, 'created_at' => now(), 'updated_at' => now()],

            // Supplier 2 (lanjutan)
            ['barang_id' => 7, 'barang_kode' => 'BRG007', 'barang_nama' => 'Pembersih Lantai Wipol',
             'harga_beli' => 12000, 'harga_jual' => 15000, 'kategori_id' => 3, 'supplier_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['barang_id' => 8, 'barang_kode' => 'BRG008', 'barang_nama' => 'Deterjen Bubuk Rinso',
             'harga_beli' => 25000, 'harga_jual' => 30000, 'kategori_id' => 3, 'supplier_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['barang_id' => 9, 'barang_kode' => 'BRG009', 'barang_nama' => 'Pewangi Pakaian Molto',
             'harga_beli' => 9000, 'harga_jual' => 11500, 'kategori_id' => 3, 'supplier_id' => 2, 'created_at' => now(), 'updated_at' => now()],

            // Supplier 2 (lanjutan)
            ['barang_id' => 10, 'barang_kode' => 'BRG010', 'barang_nama' => 'Tissue Kotak Paseo',
             'harga_beli' => 7000, 'harga_jual' => 9000, 'kategori_id' => 4, 'supplier_id' => 2, 'created_at' => now(), 'updated_at' => now()],

            // Supplier 3 (CV. Sumber Rejeki)
            ['barang_id' => 11, 'barang_kode' => 'BRG011', 'barang_nama' => 'Sabun Mandi Lifebuoy',
             'harga_beli' => 3500, 'harga_jual' => 4500, 'kategori_id' => 5, 'supplier_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['barang_id' => 12, 'barang_kode' => 'BRG012', 'barang_nama' => 'Pasta Gigi Pepsodent',
             'harga_beli' => 8000, 'harga_jual' => 10000, 'kategori_id' => 5, 'supplier_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['barang_id' => 13, 'barang_kode' => 'BRG013', 'barang_nama' => 'Shampo Clear Anti Ketombe',
             'harga_beli' => 15000, 'harga_jual' => 18000, 'kategori_id' => 5, 'supplier_id' => 3, 'created_at' => now(), 'updated_at' => now()],

            // Supplier 3 (lanjutan)
            ['barang_id' => 14, 'barang_kode' => 'BRG014', 'barang_nama' => 'Deodoran Rexona Men',
             'harga_beli' => 18000, 'harga_jual' => 22000, 'kategori_id' => 5, 'supplier_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['barang_id' => 15, 'barang_kode' => 'BRG015', 'barang_nama' => 'Sabun Cuci Muka Pond\'s',
             'harga_beli' => 20000, 'harga_jual' => 25000, 'kategori_id' => 5, 'supplier_id' => 3, 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('m_barang')->insert($data);
    }
}
