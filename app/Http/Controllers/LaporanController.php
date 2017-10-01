<?php

namespace Anbiotek\Http\Controllers;

use Illuminate\Http\Request;

use PDF;
use Excel;
use Datatables;
use Session;

use Anbiotek\Kategori;
use Anbiotek\Barang;
use Anbiotek\Merk;
use Anbiotek\Distributor;
use Anbiotek\Masuk;
use Anbiotek\DetMasuk;
use Anbiotek\Pelanggan;
use Anbiotek\Keluar;
use Anbiotek\DetKeluar;

class LaporanController extends Controller
{

    public function getLaporanBarang()
    {

    	return view('laporan.get-barang');

    }

    public function exportBarangToPDF($tipe)
    {

        if ($tipe == 'kategori') {

            $listKategori = Kategori::all();

        	return Excel::create('LAPORAN STOK PER KATEGORI '.date("d-m-Y"), function($excel) use($listKategori) {

                foreach ($listKategori as $kategori) {

                    $excel->sheet(str_limit($kategori->nmkategori, 20), function ($sheet) use($kategori) {

            			$dataRow = 7;

                        $listProduk = Barang::where('kategori_id', $kategori->id)->get();

                        $sheet->setPaperSize(5);
                        $sheet->setOrientation('portrait');
                        $sheet->setScale(90);
                        $sheet->setPageMargin(0.25);

            			$sheet->setFreeze('A7');

            			$sheet->mergeCells('A1:G1');
            			$sheet->mergeCells('A2:G2');
                        $sheet->mergeCells('A4:C4');
                        $sheet->mergeCells('F4:G4');

            			$sheet->cell('A1', function($cell) {
            				$cell->setValue('PT. ANDALAS BIOTEKNOLOGI SAIYO PADANG');
                            $cell->setFontWeight('bold');                           
                            $cell->setFontSize(11);
                            $cell->setAlignment('center');
            			});

            			$sheet->cell('A2', function($cell) use($listProduk) {
            				$cell->setValue('LAPORAN STOK PRODUK PER KATEGORI');
                            $cell->setFontWeight('bold');                           
                            $cell->setFontSize(11);
                            $cell->setAlignment('center');
            			});

                        $sheet->cell('F4', function($cell) {
                            $cell->setValue('Tanggal : '.date("d-m-Y"));                    
                            $cell->setFontSize(10);
                            $cell->setAlignment('right');
                        });

                        $sheet->cell('A4', function($cell) use($kategori) {
                            $cell->setValue('Kategori : '.$kategori->nmkategori);                    
                            $cell->setFontSize(10);
                            $cell->setAlignment('left');
                        });

                        // $sheet->cell('A1', function($cell) use($kategori) {
                        //     $cell->setValue('Laporan Stok Produk '.$kategori->nmkategori);
                        //     $cell->setFontWeight('bold');
                        //     $cell->setFontColor('#3F51B5');
                        //     $cell->setFontSize(14);
                        //     $cell->setAlignment('center');
                        // });

            			$sheet->appendRow(6, array(
                        	'NO', 'KATALOG', 'NAMA PRODUK', 'MERK', 'STOK', 'SATUAN', 'KETERANGAN'
                        ));

                        foreach ($listProduk as $key => $produk) {

                            $sheet->cell('A'.$dataRow, function($cell) use($key) { $cell->setValue($key+1); });
                        	$sheet->cell('B'.$dataRow, function($cell) use($produk) { $cell->setValue($produk->kode); });
                        	$sheet->cell('C'.$dataRow, function($cell) use($produk) { $cell->setValue($produk->nmbarang); });
                        	$sheet->cell('D'.$dataRow, function($cell) use($produk) { $cell->setValue($produk->merk->nmmerk); });
                            $sheet->cell('E'.$dataRow, function($cell) use($produk) { $cell->setValue($produk->stock); });
                        	$sheet->cell('F'.$dataRow, function($cell) use($produk) { $cell->setValue($produk->satuan->nmsatuan); });
                        	$sheet->cell('G'.$dataRow, function($cell) use($produk) { $cell->setValue($produk->ket); });

                        	$dataRow = $dataRow + 1;

                        }

                        $sheet->cells('A6:G6', function($cells) {
                        	$cells->setAlignment('center');
                            $cells->setValignment('center');
                            $cells->setFontWeight('bold');
                            $cells->setFontSize(9);
                        });

                        $sheet->cells('A7:G'.($dataRow-1), function($cells) {
                        	$cells->setFontSize(8);
                        });

                        $sheet->cells('A7:A'.($dataRow-1), function($cells) {
                            $cells->setAlignment('center');
                        });

                        $sheet->cells('B7:B'.($dataRow-1), function($cells) {
                        	$cells->setAlignment('left');
                        	$cells->setValignment('center');
                        });

                        $sheet->cells('D7:F'.($dataRow-1), function($cells) {
                        	$cells->setAlignment('center');
                        	$cells->setValignment('center');
                        });

                        $sheet->setColumnFormat(array(
                        	'A' => '@'
                        ));

                        $sheet->setBorder('A6:G'.($dataRow-1), 'thin');

                        $sheet->setWidth(array(
                            'A' => 7,
                            'B' => 15,
                            'C' => 45,
                            'D' => 15,
                            'E' => 7,
                            'F' => 10,
                            'G' => 13,
                        ));

            		});

                }

        	})->download('xls');

        } elseif ($tipe == 'keseluruhan') {

            $listProduk = Barang::all();

            return Excel::create('LAPORAN STOK KESELURUHAN '.date("d-m-Y"), function($excel) use($listProduk) {

                $excel->sheet('LAPORAN STOK', function($sheet) use($listProduk) {

                    $dataRow = 7;

                    $sheet->setPaperSize(5);
                    $sheet->setOrientation('portrait');
                    $sheet->setScale(80);
                    $sheet->setPageMargin(0.25);

                    $sheet->setFreeze('A7');

                    $sheet->mergeCells('A1:H1');
                    $sheet->mergeCells('A2:H2');
                    $sheet->mergeCells('G4:H4');

                    $sheet->cell('A1', function($cell) {
                        $cell->setValue('PT. Andalas Bioteknologi Saiyo Padang');
                        $cell->setFontWeight('bold');                    		
                        $cell->setFontSize(11);
                        $cell->setAlignment('center');
                    });

                    $sheet->cell('A2', function($cell) {
                        $cell->setValue('Laporan Stok Produk Keseluruhan');
                        $cell->setFontWeight('bold');                           
                        $cell->setFontSize(11);
                        $cell->setAlignment('center');
                    });

                    $sheet->cell('G4', function($cell) {
                        $cell->setValue('Tanggal : '.date("d-m-Y"));             		
                        $cell->setFontSize(10);
                        $cell->setAlignment('right');
                    });

                    $sheet->appendRow(6, array(
                        'NO', 'KATALOG', 'NAMA PRODUK', 'KATEGORI', 'MERK', 'STOK', 'SATUAN', 'KETERANGAN'
                    ));

                    foreach ($listProduk as $key => $produk) {

                    	$sheet->cell('A'.$dataRow, function($cell) use($key) { $cell->setValue($key+1); });
                        $sheet->cell('B'.$dataRow, function($cell) use($produk) { $cell->setValue($produk->kode); });
                        $sheet->cell('C'.$dataRow, function($cell) use($produk) { $cell->setValue($produk->nmbarang); });
                        $sheet->cell('D'.$dataRow, function($cell) use($produk) { $cell->setValue($produk->kategori->nmkategori); });
                        $sheet->cell('E'.$dataRow, function($cell) use($produk) { $cell->setValue($produk->merk->nmmerk); });
                        $sheet->cell('F'.$dataRow, function($cell) use($produk) { $cell->setValue($produk->stock); });
                        $sheet->cell('G'.$dataRow, function($cell) use($produk) { $cell->setValue($produk->satuan->nmsatuan); });
                        $sheet->cell('H'.$dataRow, function($cell) use($produk) { $cell->setValue($produk->ket); });

                        $dataRow = $dataRow + 1;

                    }

                    $sheet->cells('A6:H6', function($cells) {
                    	$cells->setAlignment('center');
                    	$cells->setValignment('center');
                    	$cells->setFontWeight('bold');
                    	$cells->setFontSize(9);
                    });

                    $sheet->cells('A7:A'.($dataRow-1), function($cells) {
                    	$cells->setAlignment('center');
                    	$cells->setValignment('center');
                    	$cells->setFontSize(8);
                    });

                    $sheet->cells('B7:E'.($dataRow-1), function($cells) {
                    	$cells->setAlignment('left');
                    	$cells->setValignment('center');
                    	$cells->setFontSize(8);
                    });

                    $sheet->cells('F7:G'.($dataRow-1), function($cells) {
                    	$cells->setAlignment('center');
                    	$cells->setValignment('center');
                    	$cells->setFontSize(8);
                    });

                    $sheet->cells('H7:H'.($dataRow-1), function($cells) {
                    	$cells->setAlignment('left');
                    	$cells->setValignment('center');
                    	$cells->setFontSize(8);
                    });

                    $sheet->setColumnFormat(array(
                        'A' => '@'
                    ));

                    $sheet->setBorder('A6:H'.($dataRow-1), 'thin');

                    $sheet->setWidth(array(
                    	'A' => 7,
                    	'B' => 15,
                    	'C' => 45,
                    	'D' => 20,
                    	'E' => 10,
                    	'F' => 7,
                    	'G' => 10,
                    	'H' => 13,
                   	));

                });

            })->download('xls');

        }

    }

    public function getLaporanStokMasuk()
    {

        return view('laporan.get-stok-masuk');

    }

    public function exportStokMasukToPDF($tipe)
    {

        if ($tipe == 'distributor') {

            return Excel::create('LAPORAN STOK MASUK PER DISTRIBUTOR '.date("d-m-Y"), function($excel) {

                $listDistributor = Distributor::all();

                foreach ($listDistributor as $distributor) {

                    $excel->sheet(str_limit($distributor->nmdistributor, 20), function($sheet) use($distributor) {

                    	$sheet->setFreeze('A6');

                    	$sheet->mergeCells('A1:K1');
                    	$sheet->mergeCells('A2:K2');
                    	$sheet->mergeCells('D4:I4');

                    	$sheet->setMergeColumn(array(
                    		'columns' => array('A','B','C', 'J', 'K'),
                    		'rows' => array(
                    			array(4,5),
                    		), true
                    	));

                    	$sheet->cell('A1', function($cell) {
                    		$cell->setValue('LAPORAN PEMBELIAN PRODUK PT. ANBIOTEK SAIYO PADANG');
                    		$cell->setFontWeight('bold');
                    		// $cell->setFontCo	lor('#3F51B5');
                    		$cell->setFontSize(10);
                    		$cell->setAlignment('center');
                    	});

                    	$sheet->cell('A2', function($cell) use($distributor) {
                    		$cell->setValue('PRODUSEN : '.$distributor->nmdistributor);
                    		$cell->setFontWeight('bold');
                    		$cell->setFontSize(10);
                    		$cell->setAlignment('center');
                    	});

                    	$sheet->appendRow(4, array(
                    		'NO', 'NO FAKTUR', 'TANGGAL', 'DETAIL PRODUK', '', '', '', '', '', 'TOTAL BAYAR', 'STATUS',
                    	));

                    	$sheet->cell('D5', function($cell) { $cell->setValue('KATALOG'); });
                    	$sheet->cell('E5', function($cell) { $cell->setValue('NAMA PRODUK'); });
                    	$sheet->cell('F5', function($cell) { $cell->setValue('QTY'); });
                    	$sheet->cell('G5', function($cell) { $cell->setValue('SATUAN'); });
                    	$sheet->cell('H5', function($cell) { $cell->setValue('HARGA'); });
                    	$sheet->cell('I5', function($cell) { $cell->setValue('SUBTOTAL'); });

                    	$sheet->cells('A4:K4', function($cells) {
                    		$cells->setAlignment('center');
                    		$cells->setValignment('center');
                    		$cells->setFontWeight('bold');
                    		$cells->setFontSize(9);
                    	});

                    	$sheet->cells('D5:I5', function($cells) {
                    		$cells->setAlignment('center');
                    		$cells->setValignment('center');
                    		$cells->setFontWeight('bold');
                    		$cells->setFontSize(9);
                    	});

                    	$sheet->setBorder('A4:K5', 'thin');

                    	$dataRow = 6;

                    	$stokMasuk = Masuk::where('distributor_id', $distributor->id)->get();

                    	$totalBayar = 0;
                    	
                    	foreach ($stokMasuk as $key => $masuk) {
                    		$xRow = $dataRow;

                    		$sheet->cell('A'.$dataRow, function($cell) use($key) { $cell->setValue($key+1); });
                    		$sheet->cell('B'.$dataRow, function($cell) use($masuk) { $cell->setValue($masuk->nobon); });
                    		$sheet->cell('C'.$dataRow, function($cell) use($masuk) { $cell->setValue($masuk->tglmasuk); });
                    		$sheet->cell('J'.$dataRow, function($cell) use($masuk) { $cell->setValue(number_format($masuk->totbay, 2)); });
                    		$sheet->cell('K'.$dataRow, function($cell) use($masuk) { $cell->setValue($masuk->status); });

                    		$detailMasuk = DetMasuk::where('masuk_id', $masuk->id)->get();

                    		foreach ($detailMasuk as $key => $detail) {
                    			$nmbarang = $detail->barang->nmbarang;
                    			$sheet->cell('D'.$xRow, function($cell) use($detail) { $cell->setValue($detail->barang_kode); });
                    			$sheet->cell('E'.$xRow, function($cell) use($nmbarang) { $cell->setValue($nmbarang); });
                    			$sheet->cell('F'.$xRow, function($cell) use($detail) { $cell->setValue($detail->stokmasuk); });
                    			$sheet->cell('G'.$xRow, function($cell) use($detail) { $cell->setValue($detail->barang->satuan->nmsatuan); });
                    			$sheet->cell('H'.$xRow, function($cell) use($detail) { $cell->setValue(number_format($detail->harga,0)); });
                    			$sheet->cell('I'.$xRow, function($cell) use($detail) { $cell->setValue(number_format($detail->subtot,0)); });
                    			$xRow = $xRow + 1;
                    		}

                    		$totalBayar = $totalBayar + $masuk->totbay;

                    		$addRow = count($detailMasuk);

                    		if ($addRow <= 1) {
                    			$dataRow = $dataRow + 1;
                    		} else {
                    			$x = $dataRow;
                    			$dataRow = $dataRow + $addRow;
                    			$y = $dataRow - 1;
                    			$sheet->mergeCells('A'.$x.':A'.$y);
                    			$sheet->mergeCells('B'.$x.':B'.$y);
                    			$sheet->mergeCells('C'.$x.':C'.$y);
                    			$sheet->mergeCells('J'.$x.':J'.$y);
                    			$sheet->mergeCells('K'.$x.':K'.$y);
                    		}

                    	}

                    	$sheet->cells('A6:A'.$dataRow, function($cells) {
                    		$cells->setAlignment('center');
                    		$cells->setValignment('center');
                    		$cells->setFontSize(8);
                    	});

                    	$sheet->cells('B6:B'.$dataRow, function($cells) {
                    		$cells->setAlignment('left');
                    		$cells->setValignment('center');
                    		$cells->setFontSize(8);
                    	});

                    	$sheet->cells('C6:C'.$dataRow, function($cells) {
                    		$cells->setAlignment('center');
                    		$cells->setValignment('center');
                    		$cells->setFontSize(8);
                    	});

                    	$sheet->cells('D6:E'.$dataRow, function($cells) {
                    		$cells->setAlignment('left');
                    		$cells->setValignment('center');
                    		$cells->setFontSize(8);
                    	});

                    	$sheet->cells('F6:G'.$dataRow, function($cells) {
                    		$cells->setAlignment('center');
                    		$cells->setValignment('center');
                    		$cells->setFontSize(8);
                    	});

                    	$sheet->cells('H6:J'.$dataRow, function($cells) {
                    		$cells->setAlignment('right');
                    		$cells->setValignment('center');
                    		$cells->setFontSize(8);
                    		$cells->setFontWeight('bold');
                    	});

                    	$sheet->cells('K6:K'.$dataRow, function($cells) {
                    		$cells->setAlignment('left');
                    		$cells->setValignment('center');
                    		$cells->setFontSize(8);
                    	});

                    	$sheet->setBorder('A6:K'.$dataRow, 'thin');

                    	$sheet->mergeCells('B'.$dataRow.':I'.$dataRow);

                    	$sheet->cell('B'.$dataRow, function($cell) {
                    		$cell->setValue('Total Transaksi Keseluruhan');
                    		$cell->setFontWeight('bold');
                    		$cell->setValignment('center');
                    		$cell->setFontSize(9);
                    	});

                    	$sheet->cell('J'.$dataRow, function($cell) use($totalBayar) { $cell->setValue(number_format($totalBayar, 2)); $cell->setFontSize(9); $cell->setValignment('center'); });

                    	$sheet->setWidth(array(
                    		'A' => 4,
                    		'B' => 15,
                    		'C' => 10,
                    		'D' => 10,
                    		'E' => 20,
                    		'F' => 7,
                    		'G' => 9,
                    		'H' => 10,
                    		'I' => 10,
                    		'J' => 12,
                    		'K' => 10
                    	));

                    });

                }

            })->download('xls');

        } elseif ($tipe == 'bulanan') {
        	
        	$listMasuk = Masuk::all();

        	$data = [

        		[ 'bulan' => 'Januari', 'transaksi' => NULL], 
        		[ 'bulan' => 'Februari', 'transaksi' => NULL], 
        		[ 'bulan' => 'Maret', 'transaksi' => NULL], 
        		[ 'bulan' => 'April', 'transaksi' => NULL], 
        		[ 'bulan' => 'Mei', 'transaksi' => NULL], 
        		[ 'bulan' => 'Juni', 'transaksi' => NULL], 
        		[ 'bulan' => 'Juli', 'transaksi' => NULL], 
        		[ 'bulan' => 'Agustus', 'transaksi' => NULL], 
        		[ 'bulan' => 'September', 'transaksi' => NULL], 
        		[ 'bulan' => 'Oktober', 'transaksi' => NULL], 
        		[ 'bulan' => 'November', 'transaksi' => NULL], 
        		[ 'bulan' => 'Desember', 'transaksi' => NULL], 

        	];

        	foreach ($listMasuk as $key => $masuk) {
        		
        		$tglmasuk = date_format(date_create($masuk->tglmasuk), "m");

        		if ($tglmasuk == '01') {
        			 
        			$data[0]['transaksi'][] = $masuk;

        		} elseif ($tglmasuk == '02') {
        			
        			$data[1]['transaksi'][] = $masuk;

        		} elseif ($tglmasuk == '03') {
        			
        			$data[2]['transaksi'][] = $masuk;

        		} elseif ($tglmasuk == '04') {
        			
        			$data[3]['transaksi'][] = $masuk;

        		} elseif ($tglmasuk == '05') {
        			
        			$data[4]['transaksi'][] = $masuk;

        		} elseif ($tglmasuk == '06') {
        			
        			$data[5]['transaksi'][] = $masuk;

        		} elseif ($tglmasuk == '07') {
        			
        			$data[6]['transaksi'][] = $masuk;

        		} elseif ($tglmasuk == '08') {
        			
        			$data[7]['transaksi'][] = $masuk;

        		} elseif ($tglmasuk == '09') {
        			
        			$data[8]['transaksi'][] = $masuk;

        		} elseif ($tglmasuk == '10') {
        			
        			$data[9]['transaksi'][] = $masuk;

        		} elseif ($tglmasuk == '11') {
        			
        			$data[10]['transaksi'][] = $masuk;

        		} elseif ($tglmasuk == '12') {
        			
        			$data[11]['transaksi'][] = $masuk;

        		} 

        	}

            return Excel::create('LAPORAN STOK MASUK PER BULAN '.date("d-m-Y"), function($excel) use($data) {

            	foreach ($data as $value) {
            		
            		$excel->sheet($value['bulan'], function($sheet) use($value) {

            			$sheet->setFreeze('A6');

                    	$sheet->mergeCells('A1:L1');
                    	$sheet->mergeCells('A2:L2');
                    	$sheet->mergeCells('E4:J4');

                    	$sheet->setMergeColumn(array(
                    		'columns' => array('A','B','C', 'D', 'K', 'L'),
                    		'rows' => array(
                    			array(4,5),
                    		), true
                    	));

                    	$sheet->cell('A1', function($cell) {
                    		$cell->setValue('LAPORAN PEMBELIAN PRODUK PT. ANBIOTEK SAIYO PADANG');
                    		$cell->setFontWeight('bold');                    		
                    		$cell->setFontSize(10);
                    		$cell->setAlignment('center');
                    	});

                    	$sheet->cell('A2', function($cell) use($value) {
                    		$cell->setValue('BULAN : '.$value['bulan'].' 2017');
                    		$cell->setFontWeight('bold');
                    		$cell->setFontSize(10);
                    		$cell->setAlignment('center');
                    	});

                    	$sheet->appendRow(4, array(
                    		'NO', 'NO FAKTUR', 'PRODUSEN', 'TANGGAL', 'DETAIL PRODUK', '', '', '', '', '', 'TOTAL BAYAR', 'STATUS',
                    	));

                    	$sheet->cell('E5', function($cell) { $cell->setValue('KATALOG'); });
                    	$sheet->cell('F5', function($cell) { $cell->setValue('NAMA PRODUK'); });
                    	$sheet->cell('G5', function($cell) { $cell->setValue('QTY'); });
                    	$sheet->cell('H5', function($cell) { $cell->setValue('SATUAN'); });
                    	$sheet->cell('I5', function($cell) { $cell->setValue('HARGA'); });
                    	$sheet->cell('J5', function($cell) { $cell->setValue('SUBTOTAL'); });

                    	$sheet->cells('A4:L4', function($cells) {
                    		$cells->setAlignment('center');
                    		$cells->setValignment('center');
                    		$cells->setFontWeight('bold');
                    		$cells->setFontSize(9);
                    	});

                    	$sheet->cells('E5:J5', function($cells) {
                    		$cells->setAlignment('center');
                    		$cells->setValignment('center');
                    		$cells->setFontWeight('bold');
                    		$cells->setFontSize(9);
                    	});

                    	$sheet->setBorder('A4:L5', 'thin');

                    	$dataRow = 6;
                    	$totalBayar = 0;

                    	$stokMasuk = collect($value['transaksi']);

                    	foreach ($stokMasuk as $key => $masuk) {
                    		
                    		$xRow = $dataRow;

                    		$sheet->cell('A'.$dataRow, function($cell) use($key) { $cell->setValue($key+1); });
                    		$sheet->cell('B'.$dataRow, function($cell) use($masuk) { $cell->setValue($masuk->nobon); });
                    		$sheet->cell('C'.$dataRow, function($cell) use($masuk) { $cell->setValue($masuk->distributor->nmdistributor); });
                    		$sheet->cell('D'.$dataRow, function($cell) use($masuk) { $cell->setValue($masuk->tglmasuk); });
                    		$sheet->cell('K'.$dataRow, function($cell) use($masuk) { $cell->setValue(number_format($masuk->totbay, 2)); });
                    		$sheet->cell('L'.$dataRow, function($cell) use($masuk) { $cell->setValue($masuk->status); });

                    		$detailMasuk = DetMasuk::where('masuk_id', $masuk->id)->get();

                    		foreach ($detailMasuk as $key => $detail) {
                    			$nmbarang = $detail->barang->nmbarang;
                    			$sheet->cell('E'.$xRow, function($cell) use($detail) { $cell->setValue($detail->barang_kode); });
                    			$sheet->cell('F'.$xRow, function($cell) use($nmbarang) { $cell->setValue($nmbarang); });
                    			$sheet->cell('G'.$xRow, function($cell) use($detail) { $cell->setValue($detail->stokmasuk); });
                    			$sheet->cell('H'.$xRow, function($cell) use($detail) { $cell->setValue($detail->barang->satuan->nmsatuan); });
                    			$sheet->cell('I'.$xRow, function($cell) use($detail) { $cell->setValue(number_format($detail->harga,0)); });
                    			$sheet->cell('J'.$xRow, function($cell) use($detail) { $cell->setValue(number_format($detail->subtot,0)); });
                    			$xRow = $xRow + 1;
                    		}

                    		$totalBayar = $totalBayar + $masuk->totbay;

                    		$addRow = count($detailMasuk);

                    		if ($addRow <= 1) {
                    			$dataRow = $dataRow + 1;
                    		} else {
                    			$x = $dataRow;
                    			$dataRow = $dataRow + $addRow;
                    			$y = $dataRow - 1;
                    			$sheet->mergeCells('A'.$x.':A'.$y);
                    			$sheet->mergeCells('B'.$x.':B'.$y);
                    			$sheet->mergeCells('C'.$x.':C'.$y);
                    			$sheet->mergeCells('D'.$x.':D'.$y);
                    			$sheet->mergeCells('K'.$x.':K'.$y);
                    			$sheet->mergeCells('L'.$x.':L'.$y);
                    		}

                    	}

                    	$sheet->cells('A6:A'.$dataRow, function($cells) {
                    		$cells->setAlignment('center');
                    		$cells->setValignment('center');
                    		$cells->setFontSize(8);
                    	});

                    	$sheet->cells('B6:C'.$dataRow, function($cells) {
                    		$cells->setAlignment('left');
                    		$cells->setValignment('center');
                    		$cells->setFontSize(8);
                    	});

                    	$sheet->cells('D6:D'.$dataRow, function($cells) {
                    		$cells->setAlignment('center');
                    		$cells->setValignment('center');
                    		$cells->setFontSize(8);
                    	});

                    	$sheet->cells('E6:F'.$dataRow, function($cells) {
                    		$cells->setAlignment('left');
                    		$cells->setValignment('center');
                    		$cells->setFontSize(8);
                    	});

                    	$sheet->cells('G6:H'.$dataRow, function($cells) {
                    		$cells->setAlignment('center');
                    		$cells->setValignment('center');
                    		$cells->setFontSize(8);
                    	});

                    	$sheet->cells('I6:K'.$dataRow, function($cells) {
                    		$cells->setAlignment('right');
                    		$cells->setValignment('center');
                    		$cells->setFontSize(8);
                    		$cells->setFontWeight('bold');
                    	});

                    	$sheet->cells('L6:L'.$dataRow, function($cells) {
                    		$cells->setAlignment('left');
                    		$cells->setValignment('center');
                    		$cells->setFontSize(8);
                    	});

                    	$sheet->setBorder('A6:L'.$dataRow, 'thin');

                    	$sheet->mergeCells('B'.$dataRow.':J'.$dataRow);

                    	$sheet->cell('B'.$dataRow, function($cell) {
                    		$cell->setValue('Total Transaksi Keseluruhan');
                    		$cell->setFontWeight('bold');
                    		$cell->setValignment('center');
                    		$cell->setFontSize(9);
                    	});

                    	$sheet->cell('K'.$dataRow, function($cell) use($totalBayar) { $cell->setValue(number_format($totalBayar, 2)); $cell->setFontSize(9); $cell->setValignment('center'); });

                    	$sheet->setWidth(array(
                    		'A' => 4,
                    		'B' => 15,
                    		'C' => 20,
                    		'D' => 10,
                    		'E' => 10,
                    		'F' => 20,
                    		'G' => 7,
                    		'H' => 9,
                    		'I' => 10,
                    		'J' => 10,
                    		'K' => 12,
                    		'L' => 10
                    	));

            		});

            	}

            })->download('xls');

        }

    }

    public function getLaporanStokKeluar()
    {

        return view('laporan.get-stok-keluar');

    }

    public function exportStokKeluarToPDF($tipe)
    {

        if ($tipe == 'pelanggan') {
            
            return Excel::create('LAPORAN STOK KELUAR PER PELANGGAN '.date("d-m-Y"), function($excel) {

                $listPelanggan = Pelanggan::all();

                foreach ($listPelanggan as $pelanggan) {
                    
                    $excel->sheet(str_limit(str_replace('/', '-', $pelanggan->nmpelanggan), 20), function($sheet) use($pelanggan) {

                        $sheet->setFreeze('A6');

                        $sheet->mergeCells('A1:K1');
                        $sheet->mergeCells('A2:K2');
                        $sheet->mergeCells('D4:I4');

                        $sheet->setMergeColumn(array(
                            'columns' => array('A','B','C', 'J', 'K'),
                            'rows' => array(
                                array(4,5),
                            ), true
                        ));

                        $sheet->cell('A1', function($cell) {
                            $cell->setValue('LAPORAN PENJUALAN PRODUK PT. ANBIOTEK SAIYO PADANG');
                            $cell->setFontWeight('bold');
                            $cell->setFontSize(10);
                            $cell->setAlignment('center');
                        });

                        $sheet->cell('A2', function($cell) use($pelanggan) {
                            $cell->setValue('PELANGGAN : '.strtoupper($pelanggan->nmpelanggan));
                            $cell->setFontWeight('bold');
                            $cell->setFontSize(10);
                            $cell->setAlignment('center');
                        });

                        $sheet->appendRow(4, array(
                            'NO', 'NO FAKTUR', 'TANGGAL', 'DETAIL PRODUK', '', '', '', '', '', 'TOTAL BAYAR', 'STATUS',
                        ));

                        $sheet->cell('D5', function($cell) { $cell->setValue('KATALOG'); });
                        $sheet->cell('E5', function($cell) { $cell->setValue('NAMA PRODUK'); });
                        $sheet->cell('F5', function($cell) { $cell->setValue('QTY'); });
                        $sheet->cell('G5', function($cell) { $cell->setValue('SATUAN'); });
                        $sheet->cell('H5', function($cell) { $cell->setValue('HARGA'); });
                        $sheet->cell('I5', function($cell) { $cell->setValue('SUBTOTAL'); });

                        $sheet->cells('A4:K4', function($cells) {
                            $cells->setAlignment('center');
                            $cells->setValignment('center');
                            $cells->setFontWeight('bold');
                            $cells->setFontSize(9);
                        });

                        $sheet->cells('D5:I5', function($cells) {
                            $cells->setAlignment('center');
                            $cells->setValignment('center');
                            $cells->setFontWeight('bold');
                            $cells->setFontSize(9);
                        });

                        $sheet->setBorder('A4:K5', 'thin');

                        $dataRow = 6;

                        $stokKeluar = Keluar::where('pelanggan_id', $pelanggan->id)->get();

                        $totalBayar = 0;

                        foreach ($stokKeluar as $key => $keluar) {

                            $xRow = $dataRow;

                            $sheet->cell('A'.$dataRow, function($cell) use($key) { $cell->setValue($key+1); });
                            $sheet->cell('B'.$dataRow, function($cell) use($keluar) { $cell->setValue($keluar->nobon); });
                            $sheet->cell('C'.$dataRow, function($cell) use($keluar) { $cell->setValue($keluar->tglkeluar); });
                            $sheet->cell('J'.$dataRow, function($cell) use($keluar) { $cell->setValue(number_format($keluar->totbay, 2)); });
                            $sheet->cell('K'.$dataRow, function($cell) use($keluar) { $cell->setValue($keluar->status); });

                            $detailKeluar = DetKeluar::where('keluar_id', $keluar->id)->get();

                            foreach ($detailKeluar as $key => $detail) {
                                $nmbarang = $detail->barang->nmbarang;
                                $sheet->cell('D'.$xRow, function($cell) use($detail) { $cell->setValue($detail->barang_kode); });
                                $sheet->cell('E'.$xRow, function($cell) use($nmbarang) { $cell->setValue($nmbarang); });
                                $sheet->cell('F'.$xRow, function($cell) use($detail) { $cell->setValue($detail->stokeluar); });
                                $sheet->cell('G'.$xRow, function($cell) use($detail) { $cell->setValue($detail->barang->satuan->nmsatuan); });
                                $sheet->cell('H'.$xRow, function($cell) use($detail) { $cell->setValue(number_format($detail->harga,0)); });
                                $sheet->cell('I'.$xRow, function($cell) use($detail) { $cell->setValue(number_format($detail->subtot,0)); });
                                $xRow = $xRow + 1;
                            }

                            $totalBayar = $totalBayar + $keluar->totbay;

                            $addRow = count($detailKeluar);

                            if ($addRow <= 1) {
                                $dataRow = $dataRow + 1;
                            } else {
                                $x = $dataRow;
                                $dataRow = $dataRow + $addRow;
                                $y = $dataRow - 1;
                                $sheet->mergeCells('A'.$x.':A'.$y);
                                $sheet->mergeCells('B'.$x.':B'.$y);
                                $sheet->mergeCells('C'.$x.':C'.$y);
                                $sheet->mergeCells('J'.$x.':J'.$y);
                                $sheet->mergeCells('K'.$x.':K'.$y);
                            }

                        }

                        $sheet->cells('A6:A'.$dataRow, function($cells) {
                            $cells->setAlignment('center');
                            $cells->setValignment('center');
                            $cells->setFontSize(8);
                        });

                        $sheet->cells('B6:B'.$dataRow, function($cells) {
                            $cells->setAlignment('left');
                            $cells->setValignment('center');
                            $cells->setFontSize(8);
                        });

                        $sheet->cells('C6:C'.$dataRow, function($cells) {
                            $cells->setAlignment('center');
                            $cells->setValignment('center');
                            $cells->setFontSize(8);
                        });

                        $sheet->cells('D6:E'.$dataRow, function($cells) {
                            $cells->setAlignment('left');
                            $cells->setValignment('center');
                            $cells->setFontSize(8);
                        });

                        $sheet->cells('F6:G'.$dataRow, function($cells) {
                            $cells->setAlignment('center');
                            $cells->setValignment('center');
                            $cells->setFontSize(8);
                        });

                        $sheet->cells('H6:J'.$dataRow, function($cells) {
                            $cells->setAlignment('right');
                            $cells->setValignment('center');
                            $cells->setFontSize(8);
                            $cells->setFontWeight('bold');
                        });

                        $sheet->cells('K6:K'.$dataRow, function($cells) {
                            $cells->setAlignment('left');
                            $cells->setValignment('center');
                            $cells->setFontSize(8);
                        });

                        $sheet->setBorder('A6:K'.$dataRow, 'thin');

                        $sheet->mergeCells('B'.$dataRow.':I'.$dataRow);

                        $sheet->cell('B'.$dataRow, function($cell) {
                            $cell->setValue('Total Transaksi Keseluruhan');
                            $cell->setFontWeight('bold');
                            $cell->setValignment('center');
                            $cell->setFontSize(9);
                        });

                        $sheet->cell('J'.$dataRow, function($cell) use($totalBayar) { $cell->setValue(number_format($totalBayar, 2)); $cell->setFontSize(9); $cell->setValignment('center'); });

                        $sheet->setWidth(array(
                            'A' => 4,
                            'B' => 15,
                            'C' => 10,
                            'D' => 10,
                            'E' => 20,
                            'F' => 7,
                            'G' => 9,
                            'H' => 10,
                            'I' => 10,
                            'J' => 12,
                            'K' => 10
                        ));

                    });

                }

            })->download('xls');

        } elseif ($tipe == 'bulanan') {

            $listKeluar = Keluar::all();

            $data = [

                [ 'bulan' => 'Januari', 'transaksi' => NULL], 
                [ 'bulan' => 'Februari', 'transaksi' => NULL], 
                [ 'bulan' => 'Maret', 'transaksi' => NULL], 
                [ 'bulan' => 'April', 'transaksi' => NULL], 
                [ 'bulan' => 'Mei', 'transaksi' => NULL], 
                [ 'bulan' => 'Juni', 'transaksi' => NULL], 
                [ 'bulan' => 'Juli', 'transaksi' => NULL], 
                [ 'bulan' => 'Agustus', 'transaksi' => NULL], 
                [ 'bulan' => 'September', 'transaksi' => NULL], 
                [ 'bulan' => 'Oktober', 'transaksi' => NULL], 
                [ 'bulan' => 'November', 'transaksi' => NULL], 
                [ 'bulan' => 'Desember', 'transaksi' => NULL], 

            ];

            foreach ($listKeluar as $key => $keluar) {
                
                $tglkeluar = date_format(date_create($keluar->tglkeluar), "m");

                if ($tglkeluar == '01') {
                     
                    $data[0]['transaksi'][] = $keluar;

                } elseif ($tglkeluar == '02') {
                    
                    $data[1]['transaksi'][] = $keluar;

                } elseif ($tglkeluar == '03') {
                    
                    $data[2]['transaksi'][] = $keluar;

                } elseif ($tglkeluar == '04') {
                    
                    $data[3]['transaksi'][] = $keluar;

                } elseif ($tglkeluar == '05') {
                    
                    $data[4]['transaksi'][] = $keluar;

                } elseif ($tglkeluar == '06') {
                    
                    $data[5]['transaksi'][] = $keluar;

                } elseif ($tglkeluar == '07') {
                    
                    $data[6]['transaksi'][] = $keluar;

                } elseif ($tglkeluar == '08') {
                    
                    $data[7]['transaksi'][] = $keluar;

                } elseif ($tglkeluar == '09') {
                    
                    $data[8]['transaksi'][] = $keluar;

                } elseif ($tglkeluar == '10') {
                    
                    $data[9]['transaksi'][] = $keluar;

                } elseif ($tglkeluar == '11') {
                    
                    $data[10]['transaksi'][] = $keluar;

                } elseif ($tglkeluar == '12') {
                    
                    $data[11]['transaksi'][] = $keluar;

                } 

            }

            return Excel::create('LAPORAN STOK KELUAR PER BULAN '.date("d-m-Y"), function($excel) use($data) {

                foreach ($data as $value) {
                    
                    $excel->sheet($value['bulan'], function($sheet) use($value) {

                        $sheet->setFreeze('A6');

                        $sheet->mergeCells('A1:L1');
                        $sheet->mergeCells('A2:L2');
                        $sheet->mergeCells('E4:J4');

                        $sheet->setMergeColumn(array(
                            'columns' => array('A','B','C', 'D', 'K', 'L'),
                            'rows' => array(
                                array(4,5),
                            ), true
                        ));

                        $sheet->cell('A1', function($cell) {
                            $cell->setValue('LAPORAN PENJUALAN PRODUK PT. ANBIOTEK SAIYO PADANG');
                            $cell->setFontWeight('bold');                           
                            $cell->setFontSize(10);
                            $cell->setAlignment('center');
                        });

                        $sheet->cell('A2', function($cell) use($value) {
                            $cell->setValue('BULAN : '.$value['bulan'].' 2017');
                            $cell->setFontWeight('bold');
                            $cell->setFontSize(10);
                            $cell->setAlignment('center');
                        });

                        $sheet->appendRow(4, array(
                            'NO', 'NO FAKTUR', 'PELANGGAN', 'TANGGAL', 'DETAIL PRODUK', '', '', '', '', '', 'TOTAL BAYAR', 'STATUS',
                        ));

                        $sheet->cell('E5', function($cell) { $cell->setValue('KATALOG'); });
                        $sheet->cell('F5', function($cell) { $cell->setValue('NAMA PRODUK'); });
                        $sheet->cell('G5', function($cell) { $cell->setValue('QTY'); });
                        $sheet->cell('H5', function($cell) { $cell->setValue('SATUAN'); });
                        $sheet->cell('I5', function($cell) { $cell->setValue('HARGA'); });
                        $sheet->cell('J5', function($cell) { $cell->setValue('SUBTOTAL'); });

                        $sheet->cells('A4:L4', function($cells) {
                            $cells->setAlignment('center');
                            $cells->setValignment('center');
                            $cells->setFontWeight('bold');
                            $cells->setFontSize(9);
                        });

                        $sheet->cells('E5:J5', function($cells) {
                            $cells->setAlignment('center');
                            $cells->setValignment('center');
                            $cells->setFontWeight('bold');
                            $cells->setFontSize(9);
                        });

                        $sheet->setBorder('A4:L5', 'thin');

                        $dataRow = 6;
                        $totalBayar = 0;

                        $stokKeluar = collect($value['transaksi']);

                        foreach ($stokKeluar as $key => $keluar) {
                            
                            $xRow = $dataRow;

                            $sheet->cell('A'.$dataRow, function($cell) use($key) { $cell->setValue($key+1); });
                            $sheet->cell('B'.$dataRow, function($cell) use($keluar) { $cell->setValue($keluar->nobon); });
                            $sheet->cell('C'.$dataRow, function($cell) use($keluar) { $cell->setValue($keluar->pelanggan->nmpelanggan); });
                            $sheet->cell('D'.$dataRow, function($cell) use($keluar) { $cell->setValue($keluar->tglmasuk); });
                            $sheet->cell('K'.$dataRow, function($cell) use($keluar) { $cell->setValue(number_format($keluar->totbay, 2)); });
                            $sheet->cell('L'.$dataRow, function($cell) use($keluar) { $cell->setValue($keluar->status); });

                            $detailKeluar = DetKeluar::where('keluar_id', $keluar->id)->get();

                            foreach ($detailKeluar as $key => $detail) {
                                $nmbarang = $detail->barang->nmbarang;
                                $sheet->cell('E'.$xRow, function($cell) use($detail) { $cell->setValue($detail->barang_kode); });
                                $sheet->cell('F'.$xRow, function($cell) use($nmbarang) { $cell->setValue($nmbarang); });
                                $sheet->cell('G'.$xRow, function($cell) use($detail) { $cell->setValue($detail->stokeluar); });
                                $sheet->cell('H'.$xRow, function($cell) use($detail) { $cell->setValue($detail->barang->satuan->nmsatuan); });
                                $sheet->cell('I'.$xRow, function($cell) use($detail) { $cell->setValue(number_format($detail->harga,0)); });
                                $sheet->cell('J'.$xRow, function($cell) use($detail) { $cell->setValue(number_format($detail->subtot,0)); });
                                $xRow = $xRow + 1;
                            }

                            $totalBayar = $totalBayar + $keluar->totbay;

                            $addRow = count($detailKeluar);

                            if ($addRow <= 1) {
                                $dataRow = $dataRow + 1;
                            } else {
                                $x = $dataRow;
                                $dataRow = $dataRow + $addRow;
                                $y = $dataRow - 1;
                                $sheet->mergeCells('A'.$x.':A'.$y);
                                $sheet->mergeCells('B'.$x.':B'.$y);
                                $sheet->mergeCells('C'.$x.':C'.$y);
                                $sheet->mergeCells('D'.$x.':D'.$y);
                                $sheet->mergeCells('K'.$x.':K'.$y);
                                $sheet->mergeCells('L'.$x.':L'.$y);
                            }

                        }

                        $sheet->cells('A6:A'.$dataRow, function($cells) {
                            $cells->setAlignment('center');
                            $cells->setValignment('center');
                            $cells->setFontSize(8);
                        });

                        $sheet->cells('B6:C'.$dataRow, function($cells) {
                            $cells->setAlignment('left');
                            $cells->setValignment('center');
                            $cells->setFontSize(8);
                        });

                        $sheet->cells('D6:D'.$dataRow, function($cells) {
                            $cells->setAlignment('center');
                            $cells->setValignment('center');
                            $cells->setFontSize(8);
                        });

                        $sheet->cells('E6:F'.$dataRow, function($cells) {
                            $cells->setAlignment('left');
                            $cells->setValignment('center');
                            $cells->setFontSize(8);
                        });

                        $sheet->cells('G6:H'.$dataRow, function($cells) {
                            $cells->setAlignment('center');
                            $cells->setValignment('center');
                            $cells->setFontSize(8);
                        });

                        $sheet->cells('I6:K'.$dataRow, function($cells) {
                            $cells->setAlignment('right');
                            $cells->setValignment('center');
                            $cells->setFontSize(8);
                            $cells->setFontWeight('bold');
                        });

                        $sheet->cells('L6:L'.$dataRow, function($cells) {
                            $cells->setAlignment('left');
                            $cells->setValignment('center');
                            $cells->setFontSize(8);
                        });

                        $sheet->setBorder('A6:L'.$dataRow, 'thin');

                        $sheet->mergeCells('B'.$dataRow.':J'.$dataRow);

                        $sheet->cell('B'.$dataRow, function($cell) {
                            $cell->setValue('Total Transaksi Keseluruhan');
                            $cell->setFontWeight('bold');
                            $cell->setValignment('center');
                            $cell->setFontSize(9);
                        });

                        $sheet->cell('K'.$dataRow, function($cell) use($totalBayar) { $cell->setValue(number_format($totalBayar, 2)); $cell->setFontSize(9); $cell->setValignment('center'); });

                        $sheet->setWidth(array(
                            'A' => 4,
                            'B' => 15,
                            'C' => 20,
                            'D' => 10,
                            'E' => 10,
                            'F' => 20,
                            'G' => 7,
                            'H' => 9,
                            'I' => 10,
                            'J' => 10,
                            'K' => 12,
                            'L' => 10
                        ));

                    });

                }

            })->download('xls');

        }

    }

}
