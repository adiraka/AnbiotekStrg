<?php

namespace Anbiotek\Http\Controllers;

use Illuminate\Http\Request;

use Datatables;
use DB;
use Session;
use Anbiotek\Barang;
use Anbiotek\Masuk;
use Anbiotek\Keluar;
use Anbiotek\Satuan;
use Anbiotek\Merk;
use Anbiotek\Kategori;
use Anbiotek\Http\Requests;

class BarangController extends Controller
{
    public function getBarang()
    {
        $satuan = Satuan::all();
        $kategori = Kategori::all();
        $merk = Merk::all();
        return view('barang.add')->with([
            'satuan' => $satuan,
            'kategori' => $kategori,
            'merk' => $merk,
        ]);
    }
    public function addBarang(Request $request)
    {
        $this->validate($request, [
            'kode' => 'required|unique:barang',
            'nmbarang' => 'required',
            'kategori_id' => 'required',
            'merk_id' => 'required',
            'stock' =>'required|integer',
            'satuan_id' => 'required',
            // 'expire' => 'required   |date',
        ]);

        $barang = new Barang;
        $barang->kode = $request->kode;
        $barang->nmbarang = $request->nmbarang;
        $barang->kategori_id = $request->kategori_id;
        $barang->merk_id = $request->merk_id;
        $barang->stock = $request->stock;
        $barang->satuan_id = $request->satuan_id;
        $barang->expire = $request->expire;
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
                <a href="'.route('ubahBarang', ['id' => $barang->kode]).'" class="btn btn-primary btn-sm btn-block">Ubah</a>
                ';
            })
            ->editColumn('kategori_id', function($barang){
                return $barang->kategori->nmkategori;
            })
            ->editColumn('satuan_id', function($barang){
                return $barang->satuan->nmsatuan;
            })
            ->editColumn('merk_id', function($barang){
                return $barang->merk->nmmerk;
            })
            ->make(true);
        }
        return view('barang.view');
    }

    public function detailBarang($id)
    {
        $satuan = Satuan::all();
        $kategori = Kategori::all();
        $merk = Merk::all();
        $barang = Barang::where('kode', '=', $id)->get()->first();
        return view('barang.get')->with([
            'satuan' => $satuan,
            'kategori' => $kategori,
            'merk' => $merk,
            'barang' => $barang,
        ]);
    }

    public function editBarang(Request $request)
    {
        $this->validate($request, [
            'kode' => 'required',
            'nmbarang' => 'required',
            'kategori_id' => 'required',
            'merk_id' => 'required',
            'stock' =>'required|integer',
            // 'expire' => 'required|date',
            'satuan_id' => 'required',
        ]);

        Barang::where('kode', $request->kode)
        ->update([
            'nmbarang' => $request->nmbarang,
            'kategori_id' => $request->kategori_id,
            'merk_id' => $request->merk_id,
            'stock' => $request->stock,
            'satuan_id' => $request->satuan_id,
            'expire' => $request->expire,
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

        DB::transaction(function() use ($request) {

            $barang = Barang::where('kode', $request->kode)->first();

            foreach ($barang->detailMasuk as $detail) {
                $masuk = Masuk::find($detail->masuk->id);
                $masuk->detail()->delete();
                $masuk->delete();
            }

            foreach ($barang->detailKeluar as $detail) {
                $keluar = Keluar::find($detail->keluar->id);
                $keluar->detail()->delete();
                $keluar->delete();
            }

            Barang::where('kode', $request->kode)->delete();

            Session::flash('success', 'Barang berhasil dihapus.');
            
        });

        Session::flash('alert', 'Telah terjadi kesalahan.');
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
        return redirect()->back();
    }

    public function getStokBarang(Request $request, $id)
    {
        if ($request->ajax()) {
            $stok = Barang::where('kode', $id)->first();
            $stoklama = [
                'nmbarang' => $stok->nmbarang,
                'merk' => $stok->merk->nmmerk,
                'stock' => $stok->stock
            ];
            return response()->json($stoklama);
        }
        return redirect()->route('login');
    }
}
