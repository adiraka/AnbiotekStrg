<?php

namespace Anbiotek\Http\Controllers;

use Illuminate\Http\Request;

use Datatables;
use Session;
use Anbiotek\Distributor;

use Anbiotek\Http\Requests;
use Anbiotek\Http\Controllers\Controller;

class DistributorController extends Controller
{
    public function getDistributor()
    {
    	return view('distributor.add');
    }

    public function addDistributor(Request $request)
    {
    	$this->validate($request, [
    		'nmdistributor' => 'required|unique:distributor'
    	]);

    	$distributor = new Distributor;
    	$distributor->nmdistributor = $request->nmdistributor;
    	$distributor->telepon = $request->telepon;
    	$distributor->alamat = $request->alamat;
    	$distributor->save();

    	Session::flash('success', 'Distributor berhasil ditambahkan.');
    	return redirect()->back();
    }

    public function viewDistributor(Request $request)
    {
    	if ($request->ajax()) {
    		return Datatables::of(Distributor::query())
                ->addColumn('action', function($distributor){
                    return '
                        <a href="'.route('ubahDistributor', ['id' => $distributor->id]).'" class="btn btn-primary btn-sm btn-block">Ubah</a>
                    ';
                })
                ->make(true);
    	}
    	return redirect()->back();
    }

    public function detailDistributor($id)
    {
    	$distributor = Distributor::find($id);
    	return view('distributor.get')->with('distributor', $distributor);
    }

    public function ubahDistributor(Request $request)
    {
    	$this->validate($request, [
    		'iddistributor' => 'required',
    		'nmdistributor' => 'required|unique:distributor',
    	]);

    	$distributor = Distributor::find($request->iddistributor);
    	$distributor->nmdistributor = $request->nmdistributor;
    	$distributor->telepon = $request->telepon;
    	$distributor->alamat = $request->alamat;
    	$distributor->save();

    	Session::flash('success', 'Distributor berhasil diubah.');
    	return redirect()->route('tambahDistributor');
    }

    public function searchDistributor(Request $request)
    {
        if ($request->ajax()) {
            $distributors = Distributor::where('nmdistributor', 'LIKE', '%'.$request->term.'%')
                                ->get();
            $count = $distributors->count();
            $distributor[] = array(
                'id' => '0',
                'text' => 'Distributor tidak ditemukan',
            );
            if ($count > 0) {
                foreach ($distributors as $key => $value) {
                    $distributor[$key]['id'] = $value->id;
                    $distributor[$key]['text'] = $value->nmdistributor;
                }
            }
            return response()->json($distributor);
        }
        return redirect()->back();
    }
}
