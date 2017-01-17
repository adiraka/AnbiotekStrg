<?php

namespace Anbiotek\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Datatables;
use Session;
use Anbiotek\Barang;
use Anbiotek\Masuk;
use Anbiotek\DetMasuk;
use Anbiotek\Pelunasan;
use Anbiotek\Http\Requests;

class MasukController extends Controller
{
    public function getMasuk()
    {
      return view('masuk.add');
    }

    public function addMasuk(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'nobon' => 'required',
            'distributor_id' => 'required',
            'tglmasuk' => 'required',
            'grandtotal' => 'required',
            'status' => 'required'
        ]);

        $detailBarang = [];
        $panjang = count($request->kode);
        for($x=0;$x<$panjang;$x++){
            $detailBarang[$x]['barang_kode'] = $request->kode[$x];
            $detailBarang[$x]['stokawal'] = $request->awal[$x];
            $detailBarang[$x]['stokmasuk'] = $request->masuk[$x];
            $detailBarang[$x]['stokakhir'] = $request->akhir[$x];
            $detailBarang[$x]['harga'] = $request->harga[$x];
            $detailBarang[$x]['subtot'] = $request->subtotal[$x];
        }

        DB::transaction(function() use ($request, $detailBarang) {
            $masuk = New Masuk;
            $masuk->user_id = $request->user_id;
            $masuk->nobon = $request->nobon;
            $masuk->distributor_id = $request->distributor_id;
            $masuk->tglmasuk = $request->tglmasuk;
            $masuk->totbay = $request->grandtotal;
            $masuk->status = $request->status;
            $masuk->tgllunas = $request->tgllunas;
            $masuk->ket = $request->ket;
            $masuk->save();

            foreach ($detailBarang as $detail) {
                $masuk->detail()->save(new DetMasuk($detail));
                DB::table('barang')->where('kode', $detail['barang_kode'])->update([
                    'stock' => $detail['stokakhir'],
                ]);
            }
        });

        Session::flash('success', 'Stok Masuk berhasil di tambahkan.');
        return redirect()->back();
    }

    public function viewMasuk(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(Masuk::query())
            ->addColumn('action', function($masuk){
                return '
                <a href="'.route('pelunasanMasuk', ['id' => $masuk->id]).'" class="btn btn-success btn-xs">PLS</a>&nbsp;|
                <a href="'.route('lihatMasukDetail', ['id' => $masuk->id]).'" class="btn btn-primary btn-xs">DTL</a>&nbsp;|
                <a href="'.route('hapusMasuk', ['id' => $masuk->id]).'" class="btn btn-danger btn-xs">HPS</a>
                ';
            })
            ->editColumn('totbay', function($masuk){
                return 'IDR '.number_format($masuk->totbay, 2);
            })
            ->editColumn('distributor_id', function($masuk){
                return $masuk->distributor->nmdistributor;
            })
            ->make(true);
        }
        return view('masuk.view');
    }

    public function detailMasuk($id)
    {
        $masuk = Masuk::find($id);
        $detailMasuk = DetMasuk::where('masuk_id', '=', $id)->get();

        return view('masuk.detail')->with([
            'masuk' => $masuk,
            'detailMasuk' => $detailMasuk,
        ]);
    }

    public function reportMasuk($id)
    {
        $masuk = Masuk::find($id);
        return view('masuk.del')->with('masuk', $masuk);
    }

    public function deleteMasuk(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
        ]);

        $masuk = Masuk::find($request->id);

        DB::transaction(function() use($masuk) {
            foreach ($masuk->detail()->get() as $detail) {
                $barang = DB::table('barang')->where('kode', $detail['barang_kode']);
                $stok = $barang->first()->stock;
                $barang->update([
                    'stock' => $stok - $detail['stokmasuk'],
                ]);
                $detail->delete();
            }
            $masuk->delete();
        });

        Session::flash('success', 'Barang masuk telah berhasil di hapus.');
        return redirect()->route('lihatMasuk');
    }

    public function pelunasanMasuk($id)
    {
        $masuk = Masuk::find($id);
        return view('masuk.lunas')->with('masuk', $masuk);
    }

    public function ubahPelunasan(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'nobon' => 'required',
            'status' => 'required',
        ]); 

        $tgllunas = NULL;

        if ($request->tgllunas != NULL) {
            $tgllunas = $request->tgllunas;
        }

        $masuk = Masuk::find($request->id);
        $masuk->status = $request->status;
        $masuk->tgllunas = $tgllunas;
        $masuk->save();

        Session::flash('success', 'Pelunasan Stok Masuk berhasil diubah.');
        return redirect()->route('lihatMasuk');
    }
}
