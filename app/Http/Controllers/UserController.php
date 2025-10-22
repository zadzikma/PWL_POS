<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use App\Models\LevelModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar User',
            'list' => ['Home', 'User']
        ];

        $page = (object)[
            'title' => 'Daftar user yang terdaftar dalam sistem'
        ];

        $activeMenu = 'user';

        $level = LevelModel::all();

        return view('user.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'level' => $level,
            'activeMenu' => $activeMenu
        ]);
    }

    public function list(Request $request)
{
    $users = UserModel::select('user_id', 'username', 'nama', 'level_id')
                ->with('level');

    // filter data user berdasarkan level_id
    if ($request->level_id) {
        $users->where('level_id', $request->level_id);
    }

    return DataTables::of($users)
        ->addIndexColumn()
        ->addColumn('aksi', function ($user) {
            $btn  = '<button onclick="modalAction(\''.url('/user/' . $user->user_id . '/show_ajax').'\')" class="btn btn-info btn-sm">Detail</button> ';
            $btn .= '<button onclick="modalAction(\''.url('/user/' . $user->user_id . '/edit_ajax').'\')" class="btn btn-warning btn-sm">Edit</button> ';
            $btn .= '<button onclick="deleteData(\''.url('/user/' . $user->user_id . '/delete_ajax').'\')" class="btn btn-danger btn-sm">Hapus</button> ';
            return $btn;
        })
        ->rawColumns(['aksi'])
        ->make(true);
}



    public function create()
    {
        $breadcrumb = (object)[
            'title' => 'Tambah User',
            'list' => ['Home', 'User', 'Tambah']
        ];

        $page = (object)[
            'title' => 'Form Tambah User'
        ];

        $level = LevelModel::all();
        $activeMenu = 'user';

        return view('user.create', compact('breadcrumb', 'page', 'activeMenu', 'level'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|min:3|unique:m_user,username',
            'nama' => 'required|string|max:100',
            'password' => 'required|min:5',
            'level_id' => 'required|integer'
        ]);

        UserModel::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => bcrypt($request->password),
            'level_id' => $request->level_id
        ]);

        return redirect('/user')->with('success', 'Data user berhasil disimpan.');
    }

    public function show(string $id)
    {
        $user = UserModel::with('level')->find($id);

        $breadcrumb = (object)[
            'title' => 'Detail User',
            'list' => ['Home', 'User', 'Detail']
        ];

        $page = (object)[
            'title' => 'Detail User'
        ];

        $activeMenu = 'user';

        return view('user.show', compact('breadcrumb', 'page', 'activeMenu', 'user'));
    }

    public function edit(string $id)
    {
        $user = UserModel::find($id);
        $level = LevelModel::all();

        $breadcrumb = (object)[
            'title' => 'Edit User',
            'list' => ['Home', 'User', 'Edit']
        ];

        $page = (object)[
            'title' => 'Edit User'
        ];

        $activeMenu = 'user';

        return view('user.edit', compact('breadcrumb', 'page', 'activeMenu', 'user', 'level'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'username' => 'required|string|min:3|unique:m_user,username,' . $id . ',user_id',
            'nama' => 'required|string|max:100',
            'password' => 'nullable|min:5',
            'level_id' => 'required|integer'
        ]);

        $user = UserModel::find($id);

        $user->update([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
            'level_id' => $request->level_id
        ]);

        return redirect('/user')->with('success', 'Data user berhasil diubah.');
    }

    //menghapus data user
    public function destroy(string $id)
    {
        $check = UserModel::find($id);
        if (!$check) {
            return redirect('/user')->with('error', 'Data user tidak ditemukan.');
        }

        try {
            UserModel::destroy($id);
            return redirect('/user')->with('success', 'Data user berhasil dihapus.');
        } catch (QueryException $e) {
            return redirect('/user')->with('error', 'Data user tidak dapat dihapus karena berelasi dengan data lain.');
        }
    }
    public function createAjax()
    {
        $level = LevelModel::select('level_id', 'level_nama')->get();
        return view('user.create_ajax', compact('level'));
    }


    public function storeAjax(Request $request)
{
    $validator = Validator::make($request->all(), [
        'username' => 'required|unique:m_user,username',
        'nama' => 'required',
        'password' => 'required',
        'level_id' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'message' => $validator->errors()->first(),
        ]);
    }

    $user = new \App\Models\UserModel();
    $user->username = $request->username;
    $user->nama = $request->nama;
    $user->password = bcrypt($request->password);
    $user->level_id = $request->level_id;
    $user->save();

    return response()->json([
        'status' => true,
        'message' => 'Data user berhasil disimpan!',
    ]);
}
    public function editAjax($id)
    {
        $user = UserModel::find($id);
        $level = LevelModel::select('level_id', 'level_nama')->get();
        return view('user.edit_ajax', ['user' => $user, 'level' => $level]);

    }
    public function updateAjax(Request $request, $id){ 
    // cek apakah request dari ajax 
    if ($request->ajax() || $request->wantsJson()) { 
        $rules = [ 
            'level_id' => 'required|integer', 
            'username' => 'required|max:20|unique:m_user,username,'.$id.',user_id', 
            'nama'     => 'required|max:100', 
            'password' => 'nullable|min:6|max:20' 
        ];
         // use Illuminate\Support\Facades\Validator; 
        $validator = Validator::make($request->all(), $rules); 
 
        if ($validator->fails()) { 
            return response()->json([ 
                'status'   => false,    // respon json, true: berhasil, false: gagal 
                'message'  => 'Validasi gagal.', 
                'msgField' => $validator->errors()  // menunjukkan field mana yang error 
            ]); 
        } 
 
        $check = UserModel::find($id); 
        if ($check) { 
            if(!$request->filled('password') ){ // jika password tidak diisi, maka hapus dari 
//request 
                $request->request->remove('password'); 
            } 
             
            $check->update($request->all()); 
            return response()->json([ 
                'status'  => true, 
                'message' => 'Data berhasil diupdate' 
            ]); 
        } else{ 
            return response()->json([ 
                'status'  => false, 
                'message' => 'Data tidak ditemukan' 
            ]); 
        } 
    } 
    return redirect('/'); 
} 
    public function confirmAjax($id){ 
        $user = UserModel::find($id); 
        return view('user.confrim_ajax', ['user' => $user]); 
    } 
  public function delete_ajax($id)
{
    if (request()->ajax() || request()->wantsJson()) {
        try {
            $user = \App\Models\UserModel::findOrFail($id);
            $user->delete();

            return response()->json([
                'status' => true,
                'message' => 'Data berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghapus data!'
            ]);
        }
    }

    abort(404);
}

} 
