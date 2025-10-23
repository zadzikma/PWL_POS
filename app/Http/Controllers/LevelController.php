<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LevelModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;


class LevelController extends Controller
{
    // Daftar Level
    public function index()
    {
        $levels = LevelModel::all();

        $breadcrumb = (object)[
            'title' => 'Daftar Level',
            'list' => ['Home', 'Level']
        ];

        $page = (object)[
            'title' => 'Daftar Level'
        ];

        $activeMenu = 'level';

        return view('level.index', compact('breadcrumb', 'page', 'activeMenu', 'levels'));
    }
    public function list(Request $request)
    {
        $query = LevelModel::select('level_id', 'level_kode', 'level_nama');

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('aksi', function ($level) {
                $btn  = '<a href="' . url('/level/' . $level->level_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<button onclick="modalAction(\'' . url('/level/' . $level->level_id . '/edit_ajax') . '\')" class="btn btn-success btn-sm">Edit Ajax</button> ';
                // 🔥 Tombol hapus pakai deleteData() SweetAlert
                $btn .= '<button onclick="deleteData(\'' . url('/level/' . $level->level_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus Ajax</button>';
                return $btn;
            })
            ->rawColumns(['aksi'])

            ->make(true);
    }



    // Form Tambah Level
    public function create()
    {
        $breadcrumb = (object)[
            'title' => 'Tambah Level',
            'list' => ['Home', 'Level', 'Tambah']
        ];

        $page = (object)[
            'title' => 'Tambah Data Level'
        ];

        $activeMenu = 'level';

        return view('level.create', compact('breadcrumb', 'page', 'activeMenu'));
    }

    // Simpan Level baru
    public function store(Request $request)
    {
        $request->validate([
            'level_kode' => 'required|string|max:10|unique:m_level,level_kode',
            'level_nama' => 'required|string|max:100'
        ]);

        LevelModel::create([
            'level_kode' => $request->level_kode,
            'level_nama' => $request->level_nama,
        ]);

        return redirect('level')->with('success', 'Data level berhasil ditambahkan');
    }

    // Form Edit Level
    public function edit(string $id)
    {
        $level = LevelModel::find($id);

        $breadcrumb = (object)[
            'title' => 'Edit Level',
            'list' => ['Home', 'Level', 'Edit']
        ];

        $page = (object)[
            'title' => 'Edit Level'
        ];

        $activeMenu = 'level';

        return view('level.edit', compact('breadcrumb', 'page', 'activeMenu', 'level'));
    }

    // Update Level
    public function update(Request $request, string $id)
    {
        $level = LevelModel::find($id);

        $request->validate([
            'level_kode' => 'required|unique:m_level,level_kode,' . $id . ',level_id',
            'level_nama' => 'required',
        ]);

        $level->update([
            'level_kode' => $request->level_kode,
            'level_nama' => $request->level_nama,
        ]);

        return redirect('level')->with('success', 'Level berhasil diupdate');
    }

    // Hapus Level
    public function destroy(string $id)
    {
        $level = LevelModel::find($id);
        if ($level) {
            $level->delete();
            return redirect('level')->with('success', 'Level berhasil dihapus');
        }
        return redirect('level')->with('error', 'Level tidak ditemukan');
    }
    public function create_ajax()
    {
        return view('level.create_ajax');
    }
    public function store_ajax(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'level_kode' => 'required|string|max:10|unique:m_level,level_kode',
            'level_nama' => 'required|string|max:100'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ]);
        }

        LevelModel::create([
            'level_kode' => $request->level_kode,
            'level_nama' => $request->level_nama,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Data level berhasil disimpan!'
        ]);
    }
    public function editAjax($id)
    {
        $level = LevelModel::find($id);
        if (!$level) {
            return response()->json(['status' => false, 'message' => 'Data tidak ditemukan']);
        }

        return view('level.edit_ajax', compact('level'));
    }

    public function update_ajax(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'level_kode' => 'required|max:10|unique:m_level,level_kode,' . $id . ',level_id',
            'level_nama' => 'required|max:100'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ]);
        }

        $level = LevelModel::find($id);
        if (!$level) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan!'
            ]);
        }

        $level->update([
            'level_kode' => $request->level_kode,
            'level_nama' => $request->level_nama
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Data level berhasil diupdate!'
        ]);
    }
    public function delete_ajax($id)
    {
        $level = LevelModel::find($id);
        return view('level.delete_ajax', compact('level'));
    }
    public function confirmAjax($id)
    {
        $level = LevelModel::find($id);
        if (!$level) {
            return response()->json(['status' => false, 'message' => 'Data tidak ditemukan']);
        }

        return view('level.confirm_ajax', compact('level'));
    }

    public function deleteAjax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $level = LevelModel::find($id);
            if ($level) {
                $level->delete();
                return response()->json(['status' => true, 'message' => 'Data berhasil dihapus!']);
            }
            return response()->json(['status' => false, 'message' => 'Data tidak ditemukan!']);
        }

        return redirect('level');
    }
    public function destroy_ajax($id)
    {
        $level = LevelModel::find($id);

        if ($level) {
            $level->delete();
            return response()->json([
                'status' => true,
                'message' => 'Data berhasil dihapus!'
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Data tidak ditemukan!'
        ]);
    }
    public function updateAjax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'level_kode' => 'required|max:10|unique:m_level,level_kode,' . $id . ',level_id',
                'level_nama' => 'required|max:100',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors()
                ]);
            }

            $level = LevelModel::find($id);
            if (!$level) {
                return response()->json(['status' => false, 'message' => 'Data tidak ditemukan']);
            }

            $level->update([
                'level_kode' => $request->level_kode,
                'level_nama' => $request->level_nama,
            ]);

            return response()->json(['status' => true, 'message' => 'Data berhasil diperbarui!']);
        }

        return redirect('level');
    }
}
