<?php

namespace Anbiotek\Http\Controllers;

use Illuminate\Http\Request;

use Datatables;
use Session;
use Anbiotek\Merk;

use Anbiotek\Http\Requests;
use Anbiotek\Http\Controllers\Controller;

class MerkController extends Controller
{
    public function getMerk()
    {
    	return view('merk.add');
    }

    public function addMerk(Request $request)
    {
    	$this->validate($request, [
    		'nmmerk' => 'required|unique:merk'
    	]);

    	$merk = new Merk;
    	$merk->nmmerk = $request->nmmerk;
    	$merk->save();

    	Session::flash('success','Merk berhasil ditambahkan.');
        return redirect()->back();
    }

    public function viewMerk(Request $request)
    {
    	if ($request->ajax()) {
    		return Datatables::of(Merk::query())
                ->addColumn('action', function($merk){
                    return '
                        <a href="'.route('ubahMerk', ['id' => $merk->id]).'" class="btn btn-primary btn-sm btn-block">Ubah</a>
                    ';
                })
                ->make(true);
    	}

    	return redirect()->back();
    }

    public function detailMerk($id)
    {
    	$merk = Merk::find($id);
        return view('merk.get')->with('merk', $merk);
    }

    public function ubahMerk(Request $request)
    {
    	$this->validate($request, [
    		'idmerk' => 'required',
    		'nmmerk' => 'required|unique:merk'
    	]);

    	$merk = Merk::find($request->idmerk);
    	$merk->nmmerk = $request->nmmerk;
    	$merk->save();

    	Session::flash('success','Merk berhasil diubah.');
        return redirect()->route('tambahMerk');
    }
}
