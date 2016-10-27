<?php

namespace Anbiotek\Http\Controllers;

use Illuminate\Http\Request;

use Datatables;
use Session;
use Anbiotek\Kategori;
use Anbiotek\Http\Requests;

class KategoriController extends Controller
{
    public function getKategori()
    {
        return view('kategori.add');
    }

    public function addKategori(Request $request)
    {
        $this->validate($request, [
            'nmkategori' => 'required|unique:kategori',
        ]);

        $kategori = new Kategori;
        $kategori->nmkategori = $request->nmkategori;
        $kategori->save();

        Session::flash('success','Kategori berhasil ditambahkan.');
        return redirect()->back();
    }

    public function viewKategori(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(Kategori::query())
                ->addColumn('action', function($kategori){
                    return '
                        <a href="'.route('lihatKategori').'" class="btn btn-success btn-xs"><i class="material-icons">mode_edit</i></a>&nbsp;
                        <a href="'.route('lihatKategori').'" class="btn btn-danger btn-xs"><i class="material-icons">delete</i></a>
                    ';
                })
                ->make(true);
        }
        return view('kategori.view');
    }
}
