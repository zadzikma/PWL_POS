<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function index()
    {
      $data = [
           'nama' => 'Pelanggan 1',
       ];
         UserModel::where('username', 'pelanggan1')->update($data);

         $user = UserModel::all();
         return view('user', ['data' => $user]);

    }
   
}
