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
      'username'=>'manager3',
      'password'=>Hash::make('manager123'),
      'nama'=>'Manager Tiga',
      'level_id'=> 2, // 1=admin, 2=manager,
      
    ];
    UserModel::create($data);

    $user = UserModel::all();
    return view('user', ['data' => $user]);
  }
}
