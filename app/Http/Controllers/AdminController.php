<?php

namespace Anbiotek\Http\Controllers;

use Illuminate\Http\Request;

use PDF;
use Anbiotek\Barang;
use Anbiotek\Kategori;
use Anbiotek\Http\Requests;

class AdminController extends Controller
{
    public function getHome()
    {
    	$totalProduk = [];
    	$kategori = Kategori::all();
    	
    	foreach ($kategori as $key => $value) {
    		$count = Barang::where('kategori_id', $value->id)->get()->count();
			$totalProduk[$key]['nmkategori'] = $value->nmkategori;
			$totalProduk[$key]['jmlhproduk'] = $count;    		
    	}

        return view('home.index')->with([
        	'totalProduk' => $totalProduk,
        ]);
    }

    public function getTestPDF()
    {
        $data = 'Budi';

        $pdf = PDF::loadView('pdf.faktur', [
            'data' => $data
        ]);

        return $pdf->stream('faktur.pdf')->header('Content-Type','application/pdf');
        dd('asdas');
    }
}
