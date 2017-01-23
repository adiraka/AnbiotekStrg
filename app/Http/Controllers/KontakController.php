<?php

namespace Anbiotek\Http\Controllers;

use Session;
use Datatables;
use Illuminate\Http\Request;

use Anbiotek\Kontak;

class KontakController extends Controller
{
    public function postKontak(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'email' => 'required|email',
            'judul' => 'required',
            'pesan' => 'required',
        ]);

    	$kontak = new Kontak;
    	$kontak->nama = $request->nama;
    	$kontak->email = $request->email;
    	$kontak->judul = $request->judul;
    	$kontak->pesan = $request->pesan;
    	$kontak->save();

    	Session::flash('sukses', 'sukses');

    	return redirect()->back();
    }

    public function viewKontak(Request $request)
    {
    	if ($request->ajax()) {
    		return Datatables::of(Kontak::query())->make(true);
    	}

    	return view('kontak.view');
    }
}
