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
        $this->validate($request, [
            'user_id' => 'required',
            'nobon' => 'required',
            'supplier' => 'required',
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
            $masuk->supplier = $request->supplier;
            $masuk->tglmasuk = $request->tglmasuk;
            $masuk->totbay = $request->grandtotal;
            $masuk->status = $request->status;
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
                <a href="'.route('lihatMasukDetail', ['id' => $masuk->id]).'" class="btn btn-primary btn-xs">Detail</a>&nbsp;
                <a href="'.route('hapusMasuk', ['id' => $masuk->id]).'" class="btn btn-danger btn-xs">Hapus</a>
                ';
            })
            ->editColumn('totbay', function($masuk){
                return 'Rp '.number_format($masuk->totbay, 2);
            })
            ->editColumn('status', function($masuk){
                if ($masuk->status == 1) {
                    return '<a href="'.route('ubahStatus', ['id' => $masuk->id, 'status' => $masuk->status]).'" class="btn btn-success btn-xs">Lunas</a>';
                } 
                return '<a href="'.route('ubahStatus', ['id' => $masuk->id, 'status' => $masuk->status]).'" class="btn btn-warning btn-xs">Belum Lunas</a>';
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

    public function ubahStatus($id, $status)
    {
        $masuk = Masuk::find($id);
        if ($status == 0) {
            $masuk->status = 1;
        } else {
            $masuk->status = 0;
        }
        $masuk->save();

        return redirect()->back();
    }
}
