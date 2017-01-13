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
                        <a href="'.route('ubahKategori', ['id' => $kategori->id]).'" class="btn btn-primary btn-sm btn-block">Ubah</a>
                    ';
                })
                ->make(true);
        }
        return view('kategori.view');
    }

    public function detailKategori($id)
    {
        $kategori = Kategori::find($id);
        return view('kategori.get')->with('kategori', $kategori);
    }

    public function editKategori(Request $request)
    {
        $this->validate($request, [
            'idkategori' => 'required',
            'nmkategori' => 'required|unique:kategori',
        ]);

        $kategori = Kategori::find($request->idkategori);
        $kategori->nmkategori = $request->nmkategori;
        $kategori->save();

        Session::flash('success','Kategori berhasil dirubah.');
        return redirect()->route('tambahKategori');
    }

    public function reportKategori($id)
    {
        $kategori = Kategori::find($id);
        return view('kategori.del')->with('kategori', $kategori);
    }

    public function deleteKategori(Request $request)
    {
        $this->validate($request, [
            'idkategori' => 'required',
        ]);

        $kategori = Kategori::find($request->idkategori);
        $kategori->delete();

        Session::flash('success', 'Kategori berhasil dihapus.');
        return redirect()->route('lihatKategori');
    }
}
