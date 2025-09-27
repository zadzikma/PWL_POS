<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanDetailSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            // Penjualan 1
            ['penjualan_id' => 1, 'barang_id' => 1, 'jumlah' => 2, 'harga' => 10000, 'created_at' => now(), 'updated_at' => now()],
            ['penjualan_id' => 1, 'barang_id' => 2, 'jumlah' => 1, 'harga' => 15000, 'created_at' => now(), 'updated_at' => now()],
            ['penjualan_id' => 1, 'barang_id' => 3, 'jumlah' => 3, 'harga' => 20000, 'created_at' => now(), 'updated_at' => now()],

            // Penjualan 2
            ['penjualan_id' => 2, 'barang_id' => 1, 'jumlah' => 1, 'harga' => 10000, 'created_at' => now(), 'updated_at' => now()],
            ['penjualan_id' => 2, 'barang_id' => 2, 'jumlah' => 2, 'harga' => 15000, 'created_at' => now(), 'updated_at' => now()],
            ['penjualan_id' => 2, 'barang_id' => 3, 'jumlah' => 2, 'harga' => 20000, 'created_at' => now(), 'updated_at' => now()],

            // Penjualan 3
            ['penjualan_id' => 3, 'barang_id' => 1, 'jumlah' => 3, 'harga' => 10000, 'created_at' => now(), 'updated_at' => now()],
            ['penjualan_id' => 3, 'barang_id' => 2, 'jumlah' => 1, 'harga' => 15000, 'created_at' => now(), 'updated_at' => now()],
            ['penjualan_id' => 3, 'barang_id' => 3, 'jumlah' => 1, 'harga' => 20000, 'created_at' => now(), 'updated_at' => now()],

            // Penjualan 4
            ['penjualan_id' => 4, 'barang_id' => 1, 'jumlah' => 4, 'harga' => 10000, 'created_at' => now(), 'updated_at' => now()],
            ['penjualan_id' => 4, 'barang_id' => 2, 'jumlah' => 2, 'harga' => 15000, 'created_at' => now(), 'updated_at' => now()],
            ['penjualan_id' => 4, 'barang_id' => 3, 'jumlah' => 3, 'harga' => 20000, 'created_at' => now(), 'updated_at' => now()],

            // Penjualan 5
            ['penjualan_id' => 5, 'barang_id' => 1, 'jumlah' => 2, 'harga' => 10000, 'created_at' => now(), 'updated_at' => now()],
            ['penjualan_id' => 5, 'barang_id' => 2, 'jumlah' => 3, 'harga' => 15000, 'created_at' => now(), 'updated_at' => now()],
            ['penjualan_id' => 5, 'barang_id' => 3, 'jumlah' => 2, 'harga' => 20000, 'created_at' => now(), 'updated_at' => now()],

            // Penjualan 6
            ['penjualan_id' => 6, 'barang_id' => 1, 'jumlah' => 1, 'harga' => 10000, 'created_at' => now(), 'updated_at' => now()],
            ['penjualan_id' => 6, 'barang_id' => 2, 'jumlah' => 2, 'harga' => 15000, 'created_at' => now(), 'updated_at' => now()],
            ['penjualan_id' => 6, 'barang_id' => 3, 'jumlah' => 4, 'harga' => 20000, 'created_at' => now(), 'updated_at' => now()],

            // Penjualan 7
            ['penjualan_id' => 7, 'barang_id' => 1, 'jumlah' => 2, 'harga' => 10000, 'created_at' => now(), 'updated_at' => now()],
            ['penjualan_id' => 7, 'barang_id' => 2, 'jumlah' => 1, 'harga' => 15000, 'created_at' => now(), 'updated_at' => now()],
            ['penjualan_id' => 7, 'barang_id' => 3, 'jumlah' => 3, 'harga' => 20000, 'created_at' => now(), 'updated_at' => now()],

            // Penjualan 8
            ['penjualan_id' => 8, 'barang_id' => 1, 'jumlah' => 3, 'harga' => 10000, 'created_at' => now(), 'updated_at' => now()],
            ['penjualan_id' => 8, 'barang_id' => 2, 'jumlah' => 2, 'harga' => 15000, 'created_at' => now(), 'updated_at' => now()],
            ['penjualan_id' => 8, 'barang_id' => 3, 'jumlah' => 1, 'harga' => 20000, 'created_at' => now(), 'updated_at' => now()],

            // Penjualan 9
            ['penjualan_id' => 9, 'barang_id' => 1, 'jumlah' => 1, 'harga' => 10000, 'created_at' => now(), 'updated_at' => now()],
            ['penjualan_id' => 9, 'barang_id' => 2, 'jumlah' => 2, 'harga' => 15000, 'created_at' => now(), 'updated_at' => now()],
            ['penjualan_id' => 9, 'barang_id' => 3, 'jumlah' => 2, 'harga' => 20000, 'created_at' => now(), 'updated_at' => now()],

            // Penjualan 10
            ['penjualan_id' => 10, 'barang_id' => 1, 'jumlah' => 2, 'harga' => 10000, 'created_at' => now(), 'updated_at' => now()],
            ['penjualan_id' => 10, 'barang_id' => 2, 'jumlah' => 3, 'harga' => 15000, 'created_at' => now(), 'updated_at' => now()],
            ['penjualan_id' => 10, 'barang_id' => 3, 'jumlah' => 4, 'harga' => 20000, 'created_at' => now(), 'updated_at' => now()],
        
        ];
        
        DB::table('t_penjualan_detail')->insert($data);
    }
}
