<?php

namespace App\Http\Controllers;
use Illumninate\Http\Request;
use Illuminate\Support\Facades\DB;
class KategoriController extends Controller
{
    public function index()
    {
        $data = [
            'kategori_kode' => 'K001',
            'kategori_nama' => 'Snack/Makanan Ringan',
            'created_at' => now(),
        ];
        DB::table('m_kategori')->insert($data);
        return "Insert data baru berhasil";
    }
}