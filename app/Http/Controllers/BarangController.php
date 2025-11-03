<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangModel;
use App\Models\KategoriModel;
use App\Models\SupplierModel;
use Yajra\DataTables\Facades\DataTables;

class BarangController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Barang',
            'list' => ['Home', 'Barang']
        ];
        $page = (object)[
            'title' => 'Data Barang'
        ];
        $activeMenu = 'barang';

        return view('barang.index', compact('breadcrumb', 'page', 'activeMenu'));
    }

    public function list()
    {
        $barang = BarangModel::select(
            'barang_id',
            'barang_kode',
            'barang_nama',
            'kategori_id',
            'supplier_id',
            'harga_beli',
            'harga_jual'
        )->with(['kategori', 'supplier']);

        return DataTables::of($barang)
            ->addIndexColumn()
            ->addColumn('kategori', fn($row) => $row->kategori->kategori_nama ?? '-')
            ->addColumn('supplier', fn($row) => $row->supplier->supplier_nama ?? '-')
            ->addColumn('harga', fn($row) =>
            'Beli: Rp ' . number_format($row->harga_beli, 0, ',', '.') .
                '<br>Jual: Rp ' . number_format($row->harga_jual, 0, ',', '.'))
            ->addColumn('aksi', function ($item) {
                $btn  = '<a href="' . url('/barang/' . $item->barang_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/barang/' . $item->barang_id) . '">'
                    . csrf_field() . method_field('DELETE')
                    . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin ingin hapus?\');">Hapus</button></form> ';
                $btn .= '<button class="btn btn-success btn-sm btn-edit-ajax" data-id="' . $item->barang_id . '">Edit AJAX</button> ';
                $btn .= '<button class="btn btn-danger btn-sm btn-hapus-ajax" data-id="' . $item->barang_id . '">Hapus AJAX</button>';
                return $btn;
            })
            ->rawColumns(['aksi', 'harga'])
            ->make(true);
    }



    public function create()
    {
        $breadcrumb = (object)[
            'title' => 'Tambah Barang',
            'list' => ['Home', 'Barang', 'Tambah']
        ];

        $page = (object)[
            'title' => 'Tambah Barang'
        ];

        $activeMenu = 'barang';
        $kategori = KategoriModel::all();
        $supplier = SupplierModel::all();

        return view('barang.create', compact('breadcrumb', 'page', 'activeMenu', 'kategori', 'supplier'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'barang_kode' => 'required|unique:m_barang,barang_kode',
            'barang_nama' => 'required',
            'harga_beli'  => 'required|numeric',
            'harga_jual'  => 'required|numeric',
            'kategori_id' => 'required|exists:m_kategori,kategori_id',
            'supplier_id' => 'required|exists:m_supplier,supplier_id',
        ]);

        BarangModel::create($request->all());

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $barang = BarangModel::findOrFail($id);
        $kategori = KategoriModel::all();
        $supplier = SupplierModel::all();

        $breadcrumb = (object)[
            'title' => 'Edit Barang',
            'list' => ['Home', 'Barang', 'Edit']
        ];

        $page = (object)[
            'title' => 'Edit Barang'
        ];

        $activeMenu = 'barang';

        return view('barang.edit', compact('breadcrumb', 'page', 'activeMenu', 'barang', 'kategori', 'supplier'));
    }

    public function update(Request $request, $id)
    {
        $barang = BarangModel::findOrFail($id);

        $request->validate([
            'barang_kode' => 'required|unique:m_barang,barang_kode,' . $barang->barang_id . ',barang_id',
            'barang_nama' => 'required',
            'harga_beli'  => 'required|numeric',
            'harga_jual'  => 'required|numeric',
            'kategori_id' => 'required|exists:m_kategori,kategori_id',
            'supplier_id' => 'required|exists:m_supplier,supplier_id',
        ]);

        $barang->update($request->all());

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui.');
    }
    public function destroy($id)
    {
        $barang = BarangModel::findOrFail($id);
        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus.');
    }
    public function storeAjax(Request $request)
    {
        $request->validate([
            'barang_kode' => 'required|unique:m_barang,barang_kode',
            'barang_nama' => 'required',
            'harga_beli'  => 'required|numeric',
            'harga_jual'  => 'required|numeric',
            'kategori_id' => 'required|exists:m_kategori,kategori_id',
            'supplier_id' => 'required|exists:m_supplier,supplier_id',
        ]);

        $barang = BarangModel::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Barang berhasil ditambahkan (AJAX)',
            'data' => $barang
        ]);
    }

    public function updateAjax(Request $request, $id)
    {
        $barang = BarangModel::findOrFail($id);

        $request->validate([
            'barang_kode' => 'required|unique:m_barang,barang_kode,' . $barang->barang_id . ',barang_id',
            'barang_nama' => 'required',
            'harga_beli'  => 'required|numeric',
            'harga_jual'  => 'required|numeric',
            'kategori_id' => 'required|exists:m_kategori,kategori_id',
            'supplier_id' => 'required|exists:m_supplier,supplier_id',
        ]);

        $barang->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Barang berhasil diperbarui (AJAX)',
            'data' => $barang
        ]);
    }
}
