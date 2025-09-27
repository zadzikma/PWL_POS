<?php

namespace App\Http\Controllers;

use Illumninate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    public function index()
    {
        /* $data = [
            'kategori_kode' => 'K001',
            'kategori_nama' => 'Snack/Makanan Ringan',
            'created_at' => now(),
        ];
        DB::table('m_kategori')->insert($data);
        return "Insert data baru berhasil"; */
        /*$rows = DB::table('m_kategori')
            ->where('kategori_kode', 'K001')
            ->update([
                'kategori_nama' => 'Camilan',
                'updated_at' => now()
            ]);
            return 'Update data berhasil. Jumlah data yang diupdate: ' . $rows.'baris';*/

        /*$rows = DB::table('m_kategori')
            ->where('kategori_kode', 'K001')
            ->delete();
        return 'Delete data berhasil. Jumlah data yang dihapus: ' . $rows . 'baris';*/

        $data = DB::table('m_kategori')->get();
        return view('kategori', ['data' => $data]);
    }
}
