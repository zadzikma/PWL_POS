<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
  public function index()
  {

   $user = UserModel::with('level')->get();
    return view('user', ['data' => $user]);
  }
  public function tambah()
  {
    return view('user_tambah');
  }
  public function tambah_simpan(Request $request) {
    UserModel::create([
        'username' => $request->username,
        'nama' => $request->nama,
        'level_id' => $request->level_id,
        'password' => Hash::make($request->password)
    ]);
    return redirect('/user/tambah')->with('success', 'User berhasil ditambah!');
  }
  public function ubah($id) {
    $user = UserModel::find($id);
    return view('user_ubah', ['data' => $user]);
  }
  public function ubah_simpan(String $id, Request $request) 
  {
    $user = UserModel::find($id);

    $user->username = $request->username;
    $user->nama = $request->nama;
    $user->password = Hash::make($request->password);
    $user->level_id = $request->level_id;
    $user->save();
    return redirect('/user');
  }
  public function hapus($id) {
    $user = UserModel::find($id);
    $user->delete();
    return redirect('/user');
  }
  
  }


