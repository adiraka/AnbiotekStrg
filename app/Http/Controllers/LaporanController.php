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
use Anbiote\Masuk;

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

                    $excel->sheet('KTGR-'.$kategori->id, function ($sheet) use($kategori) {

            			$dataRow = 5;

                        $listProduk = Barang::where('kategori_id', $kategori->id)->get();

            			$sheet->setFreeze('A5');

            			$sheet->mergeCells('A1:G1');
            			$sheet->mergeCells('A2:G2');

            			$sheet->cell('A1', function($cell) use($kategori) {
            				$cell->setValue('Laporan Stok Produk '.$kategori->nmkategori);
            				$cell->setFontWeight('bold');
                            $cell->setFontColor('#3F51B5');
            				$cell->setFontSize(14);
            				$cell->setAlignment('center');
            			});

            			$sheet->cell('A2', function($cell) use($listProduk) {
            				$cell->setValue('Tanggal '.date("d-m-Y").' | Total '.count($listProduk).' Produk');
            				$cell->setFontSize(12);
            				$cell->setAlignment('center');
            			});

            			$sheet->appendRow(4, array(
                        	'#', 'KATALOG', 'NAMA PRODUK', 'MERK', 'STOK', 'SATUAN', 'KETERANGAN'
                        ));

                        foreach ($listProduk as $produk) {

                        	$sheet->cell('B'.$dataRow, function($cell) use($produk) { $cell->setValue($produk->kode); });
                        	$sheet->cell('C'.$dataRow, function($cell) use($produk) { $cell->setValue($produk->nmbarang); });
                        	$sheet->cell('D'.$dataRow, function($cell) use($produk) { $cell->setValue($produk->merk->nmmerk); });
                            $sheet->cell('E'.$dataRow, function($cell) use($produk) { $cell->setValue($produk->stock); });
                        	$sheet->cell('F'.$dataRow, function($cell) use($produk) { $cell->setValue($produk->satuan->nmsatuan); });
                        	$sheet->cell('G'.$dataRow, function($cell) use($produk) { $cell->setValue($produk->ket); });

                        	if ($produk->stock == 0) {
                        		$sheet->cell('A'.$dataRow, function($cell) { $cell->setBackground('#FB483A'); });
                        	} elseif ($produk->stock > 0 && $produk->stock <= 5) {
                        		$sheet->cell('A'.$dataRow, function($cell) { $cell->setBackground('#FF9600'); });
                        	} else {
                        		$sheet->cell('A'.$dataRow, function($cell) { $cell->setBackground('#2B982B'); });
                        	}

                        	$dataRow = $dataRow + 1;

                        }

                        $sheet->cells('A4:G4', function($cells) {
                        	$cells->setAlignment('center');
                        	$cells->setValignment('center');
                            $cells->setBackground('#3F51B5');
                            $cells->setFontColor('#FFFFFF');
                        	$cells->setFontWeight('bold');
                        	$cells->setFontSize(12);
                        });

                        $sheet->cells('A5:G'.($dataRow-1), function($cells) {
                        	$cells->setValignment('center');
                        	$cells->setFontWeight('bold');
                        	$cells->setFontSize(9);
                        });

                        $sheet->cells('B5:B'.($dataRow-1), function($cells) {
                        	$cells->setAlignment('left');
                        	$cells->setValignment('center');
                        });

                        $sheet->cells('E1:F'.($dataRow-1), function($cells) {
                        	$cells->setAlignment('center');
                        	$cells->setValignment('center');
                        });

                        $sheet->setColumnFormat(array(
                        	'A' => '@'
                        ));

                        $sheet->setAutoSize(true);
                        $sheet->setBorder('A5:G'.($dataRow-1), 'thin');

            		});

                }

        	})->download('xls');

        } elseif ($tipe == 'merk') {

            $listMerk = Merk::all();

            return Excel::create('LAPORAN STOK PER MERK '.date("d-m-Y"), function($excel) use($listMerk) {

                foreach ($listMerk as $merk) {

                    $excel->sheet($merk->nmmerk, function($sheet) use($merk) {

                        $dataRow = 5;

                        $listProduk = Barang::where('merk_id', $merk->id)->get();

            			$sheet->setFreeze('A5');

            			$sheet->mergeCells('A1:G1');
            			$sheet->mergeCells('A2:G2');

            			$sheet->cell('A1', function($cell) use($merk) {
            				$cell->setValue('Laporan Stok Produk '.$merk->nmmerk);
            				$cell->setFontWeight('bold');
                            $cell->setFontColor('#3F51B5');
            				$cell->setFontSize(14);
            				$cell->setAlignment('center');
            			});

            			$sheet->cell('A2', function($cell) use($listProduk) {
            				$cell->setValue('Tanggal '.date("d-m-Y").' | Total '.count($listProduk).' Produk');
            				$cell->setFontSize(12);
            				$cell->setAlignment('center');
            			});

            			$sheet->appendRow(4, array(
                        	'#', 'KATALOG', 'NAMA PRODUK', 'KATEGORI', 'STOK', 'SATUAN', 'KETERANGAN'
                        ));

                        foreach ($listProduk as $produk) {

                        	$sheet->cell('B'.$dataRow, function($cell) use($produk) { $cell->setValue($produk->kode); });
                        	$sheet->cell('C'.$dataRow, function($cell) use($produk) { $cell->setValue($produk->nmbarang); });
                        	$sheet->cell('D'.$dataRow, function($cell) use($produk) { $cell->setValue($produk->kategori->nmkategori); });
                            $sheet->cell('E'.$dataRow, function($cell) use($produk) { $cell->setValue($produk->stock); });
                        	$sheet->cell('F'.$dataRow, function($cell) use($produk) { $cell->setValue($produk->satuan->nmsatuan); });
                        	$sheet->cell('G'.$dataRow, function($cell) use($produk) { $cell->setValue($produk->ket); });

                        	if ($produk->stock == 0) {
                        		$sheet->cell('A'.$dataRow, function($cell) { $cell->setBackground('#FB483A'); });
                        	} elseif ($produk->stock > 0 && $produk->stock <= 5) {
                        		$sheet->cell('A'.$dataRow, function($cell) { $cell->setBackground('#FF9600'); });
                        	} else {
                        		$sheet->cell('A'.$dataRow, function($cell) { $cell->setBackground('#2B982B'); });
                        	}

                        	$dataRow = $dataRow + 1;

                        }

                        $sheet->cells('A4:G4', function($cells) {
                        	$cells->setAlignment('center');
                        	$cells->setValignment('center');
                            $cells->setBackground('#3F51B5');
                            $cells->setFontColor('#FFFFFF');
                        	$cells->setFontWeight('bold');
                        	$cells->setFontSize(12);
                        });

                        $sheet->cells('A5:G'.($dataRow-1), function($cells) {
                        	$cells->setValignment('center');
                        	$cells->setFontWeight('bold');
                        	$cells->setFontSize(9);
                        });

                        $sheet->cells('B5:B'.($dataRow-1), function($cells) {
                        	$cells->setAlignment('left');
                        	$cells->setValignment('center');
                        });

                        $sheet->cells('E1:F'.($dataRow-1), function($cells) {
                        	$cells->setAlignment('center');
                        	$cells->setValignment('center');
                        });

                        $sheet->setColumnFormat(array(
                        	'A' => '@'
                        ));

                        $sheet->setAutoSize(true);
                        $sheet->setBorder('A5:G'.($dataRow-1), 'thin');

                    });

                }

            })->download('xls');

        } elseif ($tipe == 'keseluruhan') {

            $listProduk = Barang::all();

            return Excel::create('LAPORAN STOK KESELURUHAN '.date("d-m-Y"), function($excel) use($listProduk) {

                $excel->sheet('LAPORAN STOK', function($sheet) use($listProduk) {

                    $dataRow = 5;

                    $sheet->setFreeze('A5');

                    $sheet->mergeCells('A1:H1');
                    $sheet->mergeCells('A2:H2');

                    $sheet->cell('A1', function($cell) {
                        $cell->setValue('Laporan Stok Produk ANBIOTEK');
                        $cell->setFontWeight('bold');
                        $cell->setFontColor('#3F51B5');
                        $cell->setFontSize(14);
                        $cell->setAlignment('center');
                    });

                    $sheet->cell('A2', function($cell) use($listProduk) {
                        $cell->setValue('Tanggal '.date("d-m-Y").' | Total '.count($listProduk).' Produk');
                        $cell->setFontSize(12);
                        $cell->setAlignment('center');
                    });

                    $sheet->appendRow(4, array(
                        '#', 'KATALOG', 'NAMA PRODUK', 'KATEGORI', 'MERK', 'STOK', 'SATUAN', 'KETERANGAN'
                    ));

                    foreach ($listProduk as $produk) {

                        $sheet->cell('B'.$dataRow, function($cell) use($produk) { $cell->setValue($produk->kode); });
                        $sheet->cell('C'.$dataRow, function($cell) use($produk) { $cell->setValue($produk->nmbarang); });
                        $sheet->cell('D'.$dataRow, function($cell) use($produk) { $cell->setValue($produk->kategori->nmkategori); });
                        $sheet->cell('E'.$dataRow, function($cell) use($produk) { $cell->setValue($produk->merk->nmmerk); });
                        $sheet->cell('F'.$dataRow, function($cell) use($produk) { $cell->setValue($produk->stock); });
                        $sheet->cell('G'.$dataRow, function($cell) use($produk) { $cell->setValue($produk->satuan->nmsatuan); });
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
                        $cells->setBackground('#3F51B5');
                        $cells->setFontColor('#FFFFFF');
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

                    $sheet->cells('F1:G'.($dataRow-1), function($cells) {
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



                    });

                }

            })->download('xls');

        }

    }

}
