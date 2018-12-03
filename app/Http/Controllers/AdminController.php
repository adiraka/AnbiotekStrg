<?php

namespace Anbiotek\Http\Controllers;

use Illuminate\Http\Request;

use PDF;
use Anbiotek\Barang;
use Anbiotek\Keluar;
use Anbiotek\DetKeluar;
use Anbiotek\Masuk;
use Anbiotek\Kategori;
use Anbiotek\Http\Requests;

class AdminController extends Controller
{
    public function getHome()
    {
        $tahun = date('Y');
        $arrayPenjualan = [];
        $arrayPembelian = [];
        $nominalPenjualan = [];
        $nominalPembelian = [];
        
        for ($i=1; $i <= 12 ; $i++) { 
            $penjualan = Keluar::whereYear('tglkeluar', $tahun)->whereMonth('tglkeluar', $i)->get();
            $totalPenjualan = count($penjualan);
            $arrayPenjualan[] = $totalPenjualan;

            $tPenjualan = 0;

            foreach ($penjualan as $key => $value) {
                $tPenjualan = $tPenjualan + $value->totbay;
            }

            $nominalPenjualan[] = $tPenjualan/1000000;

            $pembelian = Masuk::whereYear('tglmasuk', $tahun)->whereMonth('tglmasuk', $i)->get();
            $totalPembelian = count($pembelian);
            $arrayPembelian[] = $totalPembelian;

            $tPembelian = 0;

            foreach ($pembelian as $key => $value) {
                $tPembelian = $tPembelian + $value->totbay;
            }

            $nominalPembelian[] = $tPembelian/1000000;
        }

        $newBarangArray = [];
        $barang = Barang::all();

        foreach ($barang as $key => $value) {
            $detKeluar = DetKeluar::where('barang_kode', $value->kode)->whereYear('created_at', $tahun)->get();
            $totalJual = 0;
            foreach ($detKeluar as $key2 => $value2) {
                $totalJual = $totalJual + $value2->stokeluar;
            }
            $newBarangArray[$key]['kode'] = $value->kode;
            $newBarangArray[$key]['nmbarang'] = $value->nmbarang;
            $newBarangArray[$key]['nmkategori'] = $value->kategori->nmkategori;
            $newBarangArray[$key]['total'] = $totalJual;
            $newBarangArray[$key]['stock'] = $value->stock;
            $newBarangArray[$key]['satuan'] = $value->satuan->nmsatuan;
        }

        $collectBarang = collect($newBarangArray)->sortByDesc('total')->take(10);

        return view('home.index')->with([
            'arrayPenjualan' => json_encode($arrayPenjualan),
            'arrayPembelian' => json_encode($arrayPembelian),
            'nominalPembelian' => json_encode($nominalPembelian),
            'nominalPenjualan' => json_encode($nominalPenjualan),
            'collectBarang' => $collectBarang
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
