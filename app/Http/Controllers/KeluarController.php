<?php

namespace Anbiotek\Http\Controllers;

use Illuminate\Http\Request;

use Anbiotek\Http\Requests;
use Anbiotek\Keluar;
use Anbiotek\DetKeluar;
use DB;
use Datatables;

class KeluarController extends Controller
{
    public function getKeluar()
    {
      return view('keluar.add');
    }

    public function addKeluar(Request $request)
    {
        $detailBarang = [];
        $panjang = count($request->kode);
        for ($i=0; $i < $panjang ; $i++) {
            $detailBarang[$i]['barang_kode'] = $request->kode[$i];
            $detailBarang[$i]['stokawal'] = $request->awal[$i];
            $detailBarang[$i]['stokeluar'] = $request->keluar[$i];
            $detailBarang[$i]['stokakhir'] = $request->akhir[$i];
            $detailBarang[$i]['harga'] = $request->harga[$i];
            $detailBarang[$i]['subtot'] = $request->subtotal[$i];
        }
        DB::transaction(function() use ($request, $detailBarang) {
            $keluar = New Keluar;
            $keluar->user_id = $request->user_id;
            $keluar->nobon = $request->nobon;
            $keluar->pemesan = $request->pemesan;
            $keluar->tglkeluar = $request->tglkeluar;
            $keluar->totbay = $request->grandtotal;
            $keluar->ket = $request->ket;
            $keluar->save();

            foreach ($detailBarang as $detail) {
                $keluar->detail()->save(new DetKeluar($detail));
                DB::table('barang')->where('kode', $detail['barang_kode'])->update([
                    'stock' => $detail['stokakhir'],
                ]);
            }
        });

        Session::flash('success', 'Barang keluar telah berhasil di tambahkan.');
        return redirect()->back();
    }

    public function viewKeluar(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(Keluar::query())
            ->addColumn('action', function($masuk){
                return '
                <a href="'.route('lihatMasukDetail', ['id' => $masuk->id]).'" class="btn btn-success btn-xs"><i class="material-icons">visibility</i></a>&nbsp;
                <a href="'.route('hapusMasuk', ['id' => $masuk->id]).'" class="btn btn-danger btn-xs"><i class="material-icons">delete</i></a>
                ';
            })
            ->make(true);
        }
        return view('keluar.view');
    }
}
