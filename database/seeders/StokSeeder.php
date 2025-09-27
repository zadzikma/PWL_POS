<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StokSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            
    [ 'supplier_id' => 1, 'barang_id' => 1,
     'user_id' => 1, 'stok_tanggal' => now(), 'stok_jumlah' => 15, 'created_at' => now(), 'updated_at' => now()],
    [ 'supplier_id' => 1, 'barang_id' => 2,
     'user_id' => 1, 'stok_tanggal' => now(), 'stok_jumlah' => 20, 'created_at' => now(), 'updated_at' => now()],
    ['supplier_id' => 1, 'barang_id' => 3,
     'user_id' => 1, 'stok_tanggal' => now(), 'stok_jumlah' => 25, 'created_at' => now(), 'updated_at' => now()],
    [ 'supplier_id' => 1, 'barang_id' => 4,
     'user_id' => 1, 'stok_tanggal' => now(), 'stok_jumlah' => 30, 'created_at' => now(), 'updated_at' => now()],
    [ 'supplier_id' => 1, 'barang_id' => 5,
     'user_id' => 1, 'stok_tanggal' => now(), 'stok_jumlah' => 18, 'created_at' => now(), 'updated_at' => now()],

    ['supplier_id' => 2, 'barang_id' => 6,
     'user_id' => 1, 'stok_tanggal' => now(), 'stok_jumlah' => 22, 'created_at' => now(), 'updated_at' => now()],
    ['supplier_id' => 2, 'barang_id' => 7,
     'user_id' => 1, 'stok_tanggal' => now(), 'stok_jumlah' => 27, 'created_at' => now(), 'updated_at' => now()],
    ['supplier_id' => 2, 'barang_id' => 8,
     'user_id' => 1, 'stok_tanggal' => now(), 'stok_jumlah' => 35, 'created_at' => now(), 'updated_at' => now()],
    ['supplier_id' => 2, 'barang_id' => 9,
     'user_id' => 1, 'stok_tanggal' => now(), 'stok_jumlah' => 40, 'created_at' => now(), 'updated_at' => now()],
    ['supplier_id' => 2, 'barang_id' => 10,
     'user_id' => 1, 'stok_tanggal' => now(), 'stok_jumlah' => 19, 'created_at' => now(), 'updated_at' => now()],

    ['supplier_id' => 3, 'barang_id' => 11,
     'user_id' => 1, 'stok_tanggal' => now(), 'stok_jumlah' => 28, 'created_at' => now(), 'updated_at' => now()],
    ['supplier_id' => 3, 'barang_id' => 12,
     'user_id' => 1, 'stok_tanggal' => now(), 'stok_jumlah' => 15, 'created_at' => now(), 'updated_at' => now()],
    ['supplier_id' => 3, 'barang_id' => 13,
     'user_id' => 1, 'stok_tanggal' => now(), 'stok_jumlah' => 20, 'created_at' => now(), 'updated_at' => now()],
    ['supplier_id' => 3, 'barang_id' => 14,
     'user_id' => 1, 'stok_tanggal' => now(), 'stok_jumlah' => 25, 'created_at' => now(), 'updated_at' => now()],
    ['supplier_id' => 3, 'barang_id' => 15,
     'user_id' => 1, 'stok_tanggal' => now(), 'stok_jumlah' => 30, 'created_at' => now(), 'updated_at' => now()],


        ]; 
        DB::table('t_stok')->insert($data);
        }
        
    }

