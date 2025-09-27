<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
    ['supplier_id' => 1, 'supplier_kode' => 'SP001', 'supplier_nama' => 'PT.Makmur Jaya',
     'supplier_alamat' => 'Malang, Jawa Timur', 'supplier_phone' => '08677438765',
     'created_at' => now(), 'updated_at' => now()],
     
    ['supplier_id' => 2, 'supplier_kode' => 'SP002', 'supplier_nama' => 'PT.Wings',
     'supplier_alamat' => 'Bandung', 'supplier_phone' => '08524478901',
     'created_at' => now(), 'updated_at' => now()],
     
    ['supplier_id' => 3, 'supplier_kode' => 'SP003', 'supplier_nama' => 'CV Sumber Rejeki',
     'supplier_alamat' => 'Sidoarjo', 'supplier_phone' => '08335678823',
     'created_at' => now(), 'updated_at' => now()],
];

        DB::table('m_supplier')->insert($data);
    }
}
