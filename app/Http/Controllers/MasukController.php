<?php

namespace Anbiotek\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Datatables;
use Session;
use Anbiotek\Barang;
use Anbiotek\Masuk;
use Anbiotek\DetMasuk;
use Anbiotek\Http\Requests;

class MasukController extends Controller
{
    public function getMasuk()
    {
      return view('masuk.add');
    }

    public function addMasuk(Request $request)
    {
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
            $masuk->supplier = $request->supplier;
            $masuk->tglmasuk = $request->tglmasuk;
            $masuk->totbay = $request->grandtotal;
            $masuk->ket = $request->ket;
            $masuk->save();

            foreach ($detailBarang as $detail) {
                $masuk->detail()->save(new DetMasuk($detail));
                DB::table('barang')->where('kode', $detail['barang_kode'])->update([
                    'stock' => $detail['stokakhir'],
                ]);
            }
        });

        Session::flash('success', 'Barang masuk telah berhasil di tambahkan.');
        return redirect()->back();
    }

    public function viewMasuk(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(Masuk::query())
            ->addColumn('action', function($masuk){
                return '
                <a href="'.route('ubahBarang', ['id' => $masuk->id]).'" class="btn btn-success btn-xs"><i class="material-icons">visibility</i></a>&nbsp;
                <a href="'.route('hapusBarang', ['id' => $masuk->id]).'" class="btn btn-danger btn-xs"><i class="material-icons">delete</i></a>
                ';
            })
            ->make(true);
        }
        return view('masuk.view');
    }
}
