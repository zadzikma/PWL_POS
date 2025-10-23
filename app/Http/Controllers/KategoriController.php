<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Kategori',
            'list' => ['Home', 'Kategori']
        ];

        $page = (object)[
            'title' => 'Data Kategori'
        ];

        $activeMenu = 'kategori';

        // Ambil semua data kategori
        $kategori = KategoriModel::all();

        return view('kategori.index', compact('breadcrumb', 'page', 'activeMenu', 'kategori'));
    }


    public function list(Request $request)
    {
        $data = KategoriModel::select('kategori_id', 'kategori_kode', 'kategori_nama');

        return DataTables::of($data)
            ->addIndexColumn() // <-- ini buat DT_RowIndex
            ->addColumn('aksi', function ($kategori) {
                $btn  = '<button onclick="modalAction(\'' . url('/kategori/' . $kategori->kategori_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/kategori/' . $kategori->kategori_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function edit($id)
    {
        $kategori = KategoriModel::find($id);

        if (!$kategori) {
            return redirect('kategori')->with('error', 'Data tidak ditemukan');
        }

        $breadcrumb = (object)[
            'title' => 'Edit Kategori',
            'list' => ['Home', 'Kategori', 'Edit']
        ];

        $page = (object)[
            'title' => 'Edit Kategori'
        ];

        $activeMenu = 'kategori';

        return view('kategori.edit', compact('breadcrumb', 'page', 'activeMenu', 'kategori'));
    }
    public function create()
    {
        $breadcrumb = (object)[
            'title' => 'Tambah Kategori',
            'list' => ['Home', 'Kategori', 'Tambah']
        ];

        $page = (object)[
            'title' => 'Tambah Kategori Baru'
        ];

        $activeMenu = 'kategori';

        return view('kategori.create', compact('breadcrumb', 'page', 'activeMenu'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'kategori_kode' => 'required|string|max:10|unique:m_kategori,kategori_kode',
            'kategori_nama' => 'required|string|max:100'
        ]);

        KategoriModel::create([
            'kategori_kode' => $request->kategori_kode,
            'kategori_nama' => $request->kategori_nama,
        ]);

        return redirect('kategori')->with('success', 'Data kategori berhasil ditambahkan!');
    }
    public function update(Request $request, string $id)
    {
        $request->validate([
            'kategori_kode' => 'required|string|max:10|unique:m_kategori,kategori_kode,' . $id . ',kategori_id',
            'kategori_nama' => 'required|string|max:100'
        ]);

        $kategori = KategoriModel::find($id);

        if ($kategori) {
            $kategori->update([
                'kategori_kode' => $request->kategori_kode,
                'kategori_nama' => $request->kategori_nama,
            ]);

            return redirect('kategori')->with('success', 'Data kategori berhasil diperbarui!');
        }

        return redirect('kategori')->with('error', 'Data kategori tidak ditemukan!');
    }
    public function create_ajax()
    {
        return view('kategori.create_ajax');
    }

    public function store_ajax(Request $request)
{
    $validator = Validator::make($request->all(), [
        'kategori_kode' => 'required|unique:m_kategori,kategori_kode',
        'kategori_nama' => 'required|unique:m_kategori,kategori_nama',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'message' => $validator->errors()->first()
        ]);
    }

    KategoriModel::create([
        'kategori_kode' => $request->kategori_kode,
        'kategori_nama' => $request->kategori_nama
    ]);

    return response()->json([
        'status' => true,
        'message' => 'Data kategori berhasil disimpan!'
    ]);
}
public function update_ajax(Request $request, $id)
{
    $validator = Validator::make($request->all(), [
        'kategori_kode' => 'required|unique:m_kategori,kategori_kode,'.$id.',kategori_id',
        'kategori_nama' => 'required|unique:m_kategori,kategori_nama,'.$id.',kategori_id',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'message' => $validator->errors()->first()
        ]);
    }

    KategoriModel::find($id)->update([
        'kategori_kode' => $request->kategori_kode,
        'kategori_nama' => $request->kategori_nama
    ]);

    return response()->json([
        'status' => true,
        'message' => 'Data kategori berhasil diperbarui!'
    ]);
}


    public function edit_ajax($id)
    {
        $kategori = KategoriModel::find($id);
        return view('kategori.edit_ajax', compact('kategori'));
    }

    

    public function confirm_ajax($id)
    {
        $kategori = KategoriModel::find($id);
        return view('kategori.confirm_ajax', compact('kategori'));
    }

    public function delete_ajax($id)
    {
        KategoriModel::destroy($id);
        return response()->json([
            'status' => true,
            'message' => 'Data berhasil dihapus!'
        ]);
    }
}
