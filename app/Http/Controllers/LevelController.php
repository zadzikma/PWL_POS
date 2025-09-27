<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LevelController extends Controller
{
    public function index()
    {
        //DB::insert(
        //'INSERT INTO m_level (level_kode, level_nama, created_at, updated_at) VALUES (?, ?, now(), now())',
        //['CUS', 'Pelanggan']
        //);

        //$row = DB::update(
        //'UPDATE m_level SET level_nama = ?, updated_at = now()  WHERE level_kode = ?',
        //['Customer Baru', 'CUS']
        //);

        //$row = DB::delete(
        //'delete from m_level where level_kode = ?',['CUS']
        //);

         $data= DB::select('select * from m_level');

        return view('level', ['data' => $data]);
    }
}
