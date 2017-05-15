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
    	return view('laporan.get-barang');
    }
}
