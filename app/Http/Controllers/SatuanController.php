<?php

namespace Anbiotek\Http\Controllers;

use Illuminate\Http\Request;

use Datatables;
use Session;
use Anbiotek\Satuan;
use Anbiotek\Http\Requests;

class SatuanController extends Controller
{
    public function getSatuan()
    {
      return view('satuan.add');
    }

    public function addSatuan(Request $request)
    {
        $this->validate($request, [
            'nmsatuan' => 'required|unique:satuan',
        ]);

        $satuan = new Satuan;
        $satuan->nmsatuan = $request->nmsatuan;
        $satuan->save();

        Session::flash('success','Kategori berhasil ditambahkan.');
        return redirect()->back();
    }

    public function viewSatuan(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(Satuan::query())
                ->addColumn('action', function($satuan){
                    return '
                        <a href="'.route('ubahSatuan', ['id' => $satuan->id]).'" class="btn btn-success btn-xs"><i class="material-icons">mode_edit</i></a>&nbsp;
                        <a href="'.route('hapusSatuan', ['id' => $satuan->id]).'" class="btn btn-danger btn-xs"><i class="material-icons">delete</i></a>
                    ';
                })
                ->make(true);
        }
        return view('satuan.view');
    }

    public function detailSatuan($id)
    {
        $satuan = Satuan::find($id);
        return view('satuan.get')->with('satuan', $satuan);
    }

    public function editSatuan(Request $request)
    {
        $this->validate($request, [
            'idsatuan' => 'required',
            'nmsatuan' => 'required|unique:satuan',
        ]);

        $satuan = Satuan::find($request->idsatuan);
        $satuan->nmsatuan = $request->nmsatuan;
        $satuan->save();

        Session::flash('success','Satuan berhasil dirubah.');
        return redirect()->route('lihatSatuan');
    }

    public function reportSatuan($id)
    {
        $satuan = Satuan::find($id);
        return view('satuan.del')->with('satuan', $satuan);
    }

    public function deleteSatuan(Request $request)
    {
        $this->validate($request, [
            'idsatuan' => 'required',
        ]);

        $satuan = Satuan::find($request->idsatuan);
        $satuan->delete();

        Session::flash('success', 'Satuan berhasil dihapus.');
        return redirect()->route('lihatSatuan');
    }
}
