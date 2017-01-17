<?php

namespace Anbiotek\Http\Controllers;

use Illuminate\Http\Request;

use Datatables;
use Session;
use Anbiotek\Pelanggan;

use Anbiotek\Http\Requests;
use Anbiotek\Http\Controllers\Controller;

class PelangganController extends Controller
{
    public function getPelanggan()
    {
    	return view('pelanggan.add');
    }

    public function addPelanggan(Request $request)
    {
    	$this->validate($request, [
    		'nmpelanggan' => 'required|unique:pelanggan',
    	]);

    	$pelanggan = new Pelanggan;
    	$pelanggan->nmpelanggan = $request->nmpelanggan;
    	$pelanggan->telepon = $request->telepon;
    	$pelanggan->alamat = $request->alamat;
    	$pelanggan->save();

    	Session::flash('success', 'Pelanggan berhasil ditambah.');
    	return redirect()->back();
    }

    public function viewPelanggan(Request $request)
    {
    	if ($request->ajax()) {
    		return Datatables::of(Pelanggan::query())
                ->addColumn('action', function($pelanggan){
                    return '
                        <a href="'.route('ubahPelanggan', ['id' => $pelanggan->id]).'" class="btn btn-primary btn-sm btn-block">Ubah</a>
                    ';
                })
                ->make(true);
    	}
    	return redirect()->back();
    }

    public function detailPelanggan($id)
    {
    	$pelanggan = Pelanggan::find($id);
    	return view('pelanggan.get')->with('pelanggan', $pelanggan);
    }

    public function ubahPelanggan(Request $request)
    {
    	$this->validate($request, [
    		'idpelanggan' => 'required',
    		'nmpelanggan' => 'required|unique:pelanggan'
    	]);

    	$pelanggan = Pelanggan::find($request->idpelanggan);
    	$pelanggan->nmpelanggan = $request->nmpelanggan;
    	$pelanggan->telepon = $request->telepon;
    	$pelanggan->alamat = $request->alamat;
    	$pelanggan->save();

    	Session::flash('success', 'Pelanggan berhasil diubah.');
    	return redirect()->route('tambahPelanggan');
    }

    public function searchPelanggan(Request $request)
    {
        if ($request->ajax()) {
            $pelanggans = Pelanggan::where('nmpelanggan', 'LIKE', '%'.$request->term.'%')
                                ->get();
            $count = $pelanggans->count();
            $pelanggan[] = array(
                'id' => '0',
                'text' => 'Pelanggan tidak ditemukan',
            );
            if ($count > 0) {
                foreach ($pelanggans as $key => $value) {
                    $pelanggan[$key]['id'] = $value->id;
                    $pelanggan[$key]['text'] = $value->nmpelanggan;
                }
            }
            return response()->json($pelanggan);
        }
        return redirect()->back();
    }
}
