<?php

namespace Anbiotek\Http\Controllers;

use Illuminate\Http\Request;

use Datatables;
use Session;
use Anbiotek\Barang;
use Anbiotek\Satuan;
use Anbiotek\Kategori;
use Anbiotek\Http\Requests;

class BarangController extends Controller
{
    public function getBarang()
    {
        $satuan = Satuan::all();
        $kategori = Kategori::all();
        // $tes = Barang::where('kode', '=', '31800-014')->get()->first()->kategori->nmkategori;
        // dd($tes);
        return view('barang.add')->with([
            'satuan' => $satuan,
            'kategori' => $kategori,
        ]);
    }
    public function addBarang(Request $request)
    {
        $this->validate($request, [
            'kode' => 'required|unique:barang',
            'nmbarang' => 'required',
            'kategori_id' => 'required',
            'merk' => 'required',
            'stock' =>'required|integer',
            'satuan_id' => 'required',
        ]);

        $barang = new Barang;
        $barang->kode = $request->kode;
        $barang->nmbarang = $request->nmbarang;
        $barang->kategori_id = $request->kategori_id;
        $barang->merk = $request->merk;
        $barang->stock = $request->stock;
        $barang->satuan_id = $request->satuan_id;
        $barang->ket = $request->ket;
        $barang->save();

        Session::flash('success','Barang berhasil ditambahkan.');
        return redirect()->back();
    }

    public function viewBarang(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(Barang::query())
                ->addColumn('action', function($barang){
                    return '
                        <a href="'.route('ubahBarang', ['id' => $barang->kode]).'" class="btn btn-success btn-xs"><i class="material-icons">mode_edit</i></a>&nbsp;
                        <a href="'.route('hapusBarang', ['id' => $barang->kode]).'" class="btn btn-danger btn-xs"><i class="material-icons">delete</i></a>
                    ';
                })
                ->editColumn('kategori_id', function($barang){
                    return $barang->kategori->nmkategori;
                })
                ->editColumn('satuan_id', function($barang){
                    return $barang->satuan->nmsatuan;
                })
                ->make(true);
        }
        return view('barang.view');
    }

    public function detailBarang($id)
    {
        $satuan = Satuan::all();
        $kategori = Kategori::all();
        $barang = Barang::where('kode', '=', $id)->get()->first();
        return view('barang.get')->with([
            'satuan' => $satuan,
            'kategori' => $kategori,
            'barang' => $barang,
        ]);
    }

    public function editBarang(Request $request)
    {
        $this->validate($request, [
            'kode' => 'required',
            'nmbarang' => 'required',
            'kategori_id' => 'required',
            'merk' => 'required',
            'stock' =>'required|integer',
            'satuan_id' => 'required',
        ]);
        dd('masuk');
    }
}
