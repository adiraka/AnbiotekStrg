<?php

namespace Anbiotek\Http\Controllers;

use Illuminate\Http\Request;

use Anbiotek\Http\Requests;
use Anbiotek\Keluar;
use Anbiotek\DetKeluar;
use Session;
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
        $this->validate($request, [
            'user_id' => 'required',
            'nobon' => 'required',
            'pelanggan_id' => 'required',
            'tglkeluar' => 'required|date',
            'grandtotal' => 'required',
            'status' => 'required',
        ]);

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
            $keluar->pelanggan_id = $request->pelanggan_id;
            $keluar->tglkeluar = $request->tglkeluar;
            $keluar->totbay = $request->grandtotal;
            $keluar->status = $request->status;
            $keluar->tgllunas = $request->tgllunas;
            $keluar->ket = $request->ket;
            $keluar->save();

            foreach ($detailBarang as $detail) {
                $keluar->detail()->save(new DetKeluar($detail));
                DB::table('barang')->where('kode', $detail['barang_kode'])->update([
                    'stock' => $detail['stokakhir'],
                ]);
            }
        });

        Session::flash('success', 'Stok Keluar berhasil di tambahkan.');
        return redirect()->back();
    }

    public function viewKeluar(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(Keluar::query())
            ->addColumn('action', function($keluar){
                return '
                <a href="'.route('pelunasanKeluar', ['id' => $keluar->id]).'" class="btn btn-success btn-xs">PLS</a>&nbsp;|
                <a href="'.route('lihatKeluarDetail', ['id' => $keluar->id]).'" class="btn btn-primary btn-xs">DTL</a>&nbsp;|
                <a href="'.route('hapusMasuk', ['id' => $keluar->id]).'" class="btn btn-danger btn-xs">HPS</a>
                ';
            })
            ->editColumn('totbay', function($keluar){
                return 'IDR '.number_format($keluar->totbay, 2);
            })
            ->editColumn('pelanggan_id', function($keluar){
                return $keluar->pelanggan->nmpelanggan;
            })
            ->make(true);
        }
        return view('keluar.view');
    }

    public function detailKeluar($id)
    {
        $keluar = Keluar::find($id);
        $detailKeluar = DetKeluar::where('keluar_id', '=', $id)->get();

        return view('keluar.detail')->with([
            'keluar' => $keluar,
            'detailKeluar' => $detailKeluar,
        ]);
    }

    public function pelunasanKeluar($id)
    {
        $keluar = Keluar::find($id);
        return view('keluar.lunas')->with('keluar', $keluar);
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

        $keluar = Keluar::find($request->id);
        $keluar->status = $request->status;
        $keluar->tgllunas = $tgllunas;
        $keluar->save();

        Session::flash('success', 'Pelunasan Stok Keluar berhasil diubah.');
        return redirect()->route('lihatKeluar');
    }
}
