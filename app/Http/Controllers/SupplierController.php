<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SupplierModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Supplier',
            'list' => ['Home', 'Supplier']
        ];

        $page = (object)[
            'title' => 'Data Supplier'
        ];

        $activeMenu = 'supplier';

        return view('supplier.index', compact('breadcrumb', 'page', 'activeMenu'));
    }

    public function list(Request $request){
    $data = SupplierModel::select('supplier_id','supplier_kode','supplier_nama','supplier_alamat','supplier_phone');
    return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('aksi', function($row){
            $btn  = '<button onclick="modalAction(\''.url('/supplier/'.$row->supplier_id.'/edit_ajax').'\')" class="btn btn-warning btn-sm">Edit</button> ';
            $btn .= '<button onclick="deleteData(\''.url('/supplier/'.$row->supplier_id.'/delete_ajax').'\')" class="btn btn-danger btn-sm">Hapus</button>';
            return $btn;
        })
        ->rawColumns(['aksi'])
        ->make(true);
}

    public function create()
    {
        $breadcrumb = (object)[
            'title' => 'Tambah Supplier',
            'list' => ['Home', 'Supplier', 'Tambah']
        ];

        $page = (object)[
            'title' => 'Tambah Supplier'
        ];

        $activeMenu = 'supplier';

        return view('supplier.create', compact('breadcrumb', 'page', 'activeMenu'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_kode' => 'required|unique:m_supplier,supplier_kode',
            'supplier_nama' => 'required',
        ]);

        SupplierModel::create($request->all());

        return redirect('supplier')->with('success', 'Supplier berhasil ditambahkan');
    }

    public function edit($id)
    {
        $supplier = SupplierModel::find($id);

        if (!$supplier) {
            return redirect('supplier')->with('error', 'Data tidak ditemukan');
        }

        $breadcrumb = (object)[
            'title' => 'Edit Supplier',
            'list' => ['Home', 'Supplier', 'Edit']
        ];

        $page = (object)[
            'title' => 'Edit Supplier'
        ];

        $activeMenu = 'supplier';

        return view('supplier.edit', compact('breadcrumb', 'page', 'activeMenu', 'supplier'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'supplier_kode' => 'required',
            'supplier_nama' => 'required',
            'supplier_alamat' => 'required',
            'supplier_phone' => 'required'
        ]);

        $supplier = SupplierModel::find($id);
        $supplier->update($request->all());

        return redirect('supplier')->with('success', 'Data berhasil diperbarui');
    }


    public function destroy($id)
    {
        SupplierModel::find($id)->delete();
        return redirect('supplier')->with('success', 'Data berhasil dihapus');
    }
    public function store_ajax(Request $request){
    $validator = Validator::make($request->all(),[
        'supplier_kode' => 'required|unique:m_supplier,supplier_kode',
        'supplier_nama' => 'required|unique:m_supplier,supplier_nama'
    ]);

    if($validator->fails()){
        return response()->json(['status'=>false,'message'=>$validator->errors()->first()]);
    }

    SupplierModel::create([
        'supplier_kode' => $request->supplier_kode,
        'supplier_nama' => $request->supplier_nama,
        'supplier_alamat' => $request->supplier_alamat,
        'supplier_phone' => $request->supplier_phone
    ]);

    return response()->json(['status'=>true,'message'=>'Supplier berhasil disimpan!']);
}

public function update_ajax(Request $request, $id){
    $validator = Validator::make($request->all(),[
        'supplier_kode' => 'required|unique:m_supplier,supplier_kode,'.$id.',supplier_id',
        'supplier_nama' => 'required|unique:m_supplier,supplier_nama,'.$id.',supplier_id'
    ]);

    if($validator->fails()){
        return response()->json(['status'=>false,'message'=>$validator->errors()->first()]);
    }

    SupplierModel::find($id)->update([
        'supplier_kode' => $request->supplier_kode,
        'supplier_nama' => $request->supplier_nama,
        'supplier_alamat' => $request->supplier_alamat,
        'supplier_phone' => $request->supplier_phone
    ]);

    return response()->json(['status'=>true,'message'=>'Supplier berhasil diperbarui!']);
}
}
