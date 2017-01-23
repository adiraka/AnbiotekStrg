<?php

namespace Anbiotek\Http\Controllers;

use Illuminate\Http\Request;

use PDF;
use Datatables;
use Session;

use Anbiotek\Kategori;
use Anbiotek\Barang;

class LaporanController extends Controller
{
    public function getLaporanBarang()
    {
    	$kategori = Kategori::all();

    	$reportbarang = [];

    	foreach ($kategori as $key => $value) {
    		$reportbarang[$key]['nmkategori'] = $value->nmkategori;
    		$reportbarang[$key]['produk'] = Barang::where('kategori_id', $value->id)->get();
    	}
    	
    	view()->share('reportbarang', $reportbarang);

    	$pdf = PDF::loadView('laporan.get-barang')->setPaper('a4');
    	return $pdf->stream(date('dmY').'stok.pdf');

    	// return view('laporan.get-barang')->with([
    	// 	'reportbarang' => $reportbarang,
    	// ]);
    }
}
