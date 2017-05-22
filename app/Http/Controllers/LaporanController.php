<?php

namespace Anbiotek\Http\Controllers;

use Illuminate\Http\Request;

use PDF;
use Excel;
use Datatables;
use Session;

use Anbiotek\Kategori;
use Anbiotek\Barang;

class LaporanController extends Controller
{
    public function getLaporanBarang()
    {
        $listKategori = Kategori::all();
    	return view('laporan.get-barang')->with([
            'listKategori' => $listKategori,
        ]);
    }

    public function exportBarangToPDF($id)
    {
    	$kategori = Kategori::find($id);
    	// dd($kategori);

    	return Excel::create('LAPORAN STOK '.$kategori->nmkategori.' '.date("d-m-Y"), function($excel) use($kategori) {
    		
    		$excel->sheet('STOK', function ($sheet) use($kategori) {

    			$dataRow = 5;

                $listProduk = Barang::where('kategori_id', $kategori->id)->get();

    			$sheet->setFreeze('A5');

    			$sheet->mergeCells('A1:H1');
    			$sheet->mergeCells('A2:H2');
    			$sheet->mergeCells('A3:H3');

    			$sheet->cell('A1', function($cell) use($kategori) {
    				$cell->setValue('Laporan Stok Produk '.$kategori->nmkategori);
    				$cell->setFontWeight('bold');
    				$cell->setFontSize(14);
    				$cell->setAlignment('center');
    			});

    			$sheet->cell('A2', function($cell) use($listProduk) {
    				$cell->setValue('Tanggal '.date("d-m-Y").' | Total '.count($listProduk).' Produk');
    				$cell->setFontSize(12);
    				$cell->setAlignment('center');
    			});

    			$sheet->appendRow(4, array(
                	'#', 'KATALOG', 'NAMA PRODUK', 'MERK', 'STOK', 'SATUAN', 'EXPIRED', 'KETERANGAN'        
                ));

                foreach ($listProduk as $produk) {
                	
                	$sheet->cell('B'.$dataRow, function($cell) use($produk) { $cell->setValue($produk->kode); });
                	$sheet->cell('C'.$dataRow, function($cell) use($produk) { $cell->setValue($produk->nmbarang); });
                	$sheet->cell('D'.$dataRow, function($cell) use($produk) { $cell->setValue($produk->merk->nmmerk); });
                	$sheet->cell('F'.$dataRow, function($cell) use($produk) { $cell->setValue($produk->satuan->nmsatuan); });
                	$sheet->cell('E'.$dataRow, function($cell) use($produk) { $cell->setValue($produk->stock); });
                	$sheet->cell('G'.$dataRow, function($cell) use($produk) { $cell->setValue($produk->expire); });
                	$sheet->cell('H'.$dataRow, function($cell) use($produk) { $cell->setValue($produk->ket); });

                	if ($produk->stock == 0) {
                		$sheet->cell('A'.$dataRow, function($cell) { $cell->setBackground('#FB483A'); });
                	} elseif ($produk->stock > 0 && $produk->stock <= 5) {
                		$sheet->cell('A'.$dataRow, function($cell) { $cell->setBackground('#FF9600'); });
                	} else {
                		$sheet->cell('A'.$dataRow, function($cell) { $cell->setBackground('#2B982B'); });
                	}

                	$dataRow = $dataRow + 1;

                }

                $sheet->cells('A4:H4', function($cells) {
                	$cells->setAlignment('center');
                	$cells->setValignment('center');
                	$cells->setFontWeight('bold');
                	$cells->setFontSize(12);
                });

                $sheet->cells('A5:H'.($dataRow-1), function($cells) {
                	$cells->setValignment('center');
                	$cells->setFontWeight('bold');
                	$cells->setFontSize(9);
                });

                $sheet->cells('B5:B'.($dataRow-1), function($cells) {
                	$cells->setAlignment('left');
                	$cells->setValignment('center');
                });

                $sheet->cells('E1:G'.($dataRow-1), function($cells) {
                	$cells->setAlignment('center');
                	$cells->setValignment('center');
                });

                $sheet->setColumnFormat(array(
                	'A' => '@'
                ));

                $sheet->setAutoSize(true);
                $sheet->setBorder('A5:H'.($dataRow-1), 'thin');

    		});

    	})->download('xls');
    }
}
