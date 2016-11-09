<?php

namespace Anbiotek\Http\Controllers;

use Illuminate\Http\Request;

use Datatables;
use DB;
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

        Barang::where('kode', $request->kode)
        ->update([
            'nmbarang' => $request->nmbarang,
            'kategori_id' => $request->kategori_id,
            'merk' => $request->merk,
            'stock' => $request->stock,
            'satuan_id' => $request->satuan_id,
            'ket' => $request->ket,
        ]);

        Session::flash('success','Barang berhasil dirubah.');
        return redirect()->route('lihatBarang');
    }

    public function reportBarang($id)
    {
        $barang = Barang::where('kode', '=', $id)->get()->first();
        return view('barang.del')->with('barang', $barang);
    }

    public function deleteBarang(Request $request)
    {
        $this->validate($request, [
            'kode' => 'required',
        ]);

        Barang::where('kode', $request->kode)->delete();

        Session::flash('success', 'Barang berhasil dihapus.');
        return redirect()->route('lihatBarang');
    }

    public function searchBarang(Request $request)
    {
        if ($request->ajax()) {
            $barangs = Barang::where('kode', 'LIKE', '%'.$request->term.'%')
                                ->orwhere('nmbarang', 'LIKE', '%'.$request->term.'%')
                                ->get();
            $count = $barangs->count();
            $barang[] = array(
                'id' => '0',
                'text' => 'Barang tidak ditemukan',
            );
            if ($count > 0) {
                foreach ($barangs as $key => $value) {
                    $barang[$key]['id'] = $value->kode;
                    $barang[$key]['text'] = $value->kode.' - '.$value->nmbarang;
                }
            }
            return response()->json($barang);
        }
        return redirect()->route('login');
    }

    public function getStokBarang(Request $request, $id)
    {
        if ($request->ajax()) {
            $stok = DB::table('barang')->select('nmbarang','merk','stock')
                        ->where('kode', '=', $id)
                        ->get()->first();
            return response()->json($stok);
        }
        return redirect()->route('login');
    }
}
