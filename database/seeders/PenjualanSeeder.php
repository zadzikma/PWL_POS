<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
           
    ['user_id' => 3, 'tgl_penjualan' => now(),
     'created_at' => now(), 'updated_at' => now()],

    ['user_id' => 2, 'tgl_penjualan' => now(),
     'created_at' => now(), 'updated_at' => now()],

    ['user_id' => 1, 'tgl_penjualan' => now(),
     'created_at' => now(), 'updated_at' => now()],

    ['user_id' => 3, 'tgl_penjualan' => now(),
     'created_at' => now(), 'updated_at' => now()],

    ['user_id' => 2, 'tgl_penjualan' => now(),
     'created_at' => now(), 'updated_at' => now()],

    ['user_id' => 1, 'tgl_penjualan' => now(),
     'created_at' => now(), 'updated_at' => now()],

    ['user_id' => 3, 'tgl_penjualan' => now(),
     'created_at' => now(), 'updated_at' => now()],

    ['user_id' => 2, 'tgl_penjualan' => now(),
     'created_at' => now(), 'updated_at' => now()],

    ['user_id' => 1, 'tgl_penjualan' => now(),
     'created_at' => now(), 'updated_at' => now()],

    ['user_id' => 3, 'tgl_penjualan' => now(),
     'created_at' => now(), 'updated_at' => now()],

        ];
        
        DB::table('t_penjualan')->insert($data);
    }
}
