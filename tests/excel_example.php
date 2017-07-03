<?php

namespace RSunandSite\Http\Controllers\Backend;

use Illuminate\Http\Request;
use RSunandSite\Http\Controllers\Controller;
use RSunandSite\Models\Peminatan;
use RSunandSite\Models\Karir;
use RSunandSite\Models\Pelatihan;
use RSunandSite\Models\Pengalaman;
use Excel;
use Storage;
use Datatables;

class KarirController extends Controller
{
	//datatable
    public function getKarirAdmin(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(Karir::query())
            ->editColumn('peminatan_id', function($detailPeserta) {
                return $detailPeserta->peminatan->nm_peminatan;
            })
            ->editColumn('tgl_lahir', function($detailPeserta) {
                return $detailPeserta->tmp_lahir.', '.$detailPeserta->tgl_lahir;
            })
            ->addColumn('action', function ($detailPeserta) {
                return '<a href="'.route('kp-karir-detail', [$detailPeserta->id]).'" class="link-aktiv"> DETAIL</a>';
            })
            ->make(true);
        }
        $count = Karir::all()->count();
        return view('backend.karir.vkarir')->with([
            'count' => $count
        ]);
    }

    public function getKarirDetail($id)
    {
        $detailPeserta = Karir::find($id);
        $count = Karir::all()->count();

        $kodePeminatan = substr($detailPeserta->peminatan->nm_peminatan, 0, 2);

        return view('backend.karir.detail')->with([
            'detailPeserta' => $detailPeserta,
            'kodePeminatan' => $kodePeminatan,
            'count' => $count
        ]);
    }

    public function getKarirDownload($id)
    {
        $data = Karir::find($id);
        $filename = $data->lampiran;
        $exist = Storage::disk('berkas')->exists($filename);
        // dd($exist);
        if ($exist) {
            return response()->download(storage_path().'/berkas/'.$filename, $data->peminatan->nm_peminatan. " + ".$data->ktp. " + ".$data->nama.".pdf");
        } else {
            return redirect()->route('kp-beranda');
        }
    }

    //excel
    public function getKarirExcel()
    {
        $test = Karir::select('ktp', 'nama', 'tmp_lahir', 'tgl_lahir', 'jekel', 'status', 'agama',
                                'suku', 'telepon', 'email', 'alamat', 'sma_asal', 'nilai_rata', 'univ_asal',
                                'jurusan', 'nilai_ipk', 'no_str', 'th_str')
                                ->where('peminatan_id', 5)->get()->toArray();

        // dd($test);
        $peminatan = Peminatan::all();
        $data = [];
        foreach ($peminatan as $key => $value) {
            $data[$key]['kd'] = $value->nm_peminatan;
            $data[$key]['data'] = Karir::select('ktp', 'nama', 'tmp_lahir', 'tgl_lahir', 'jekel', 'status', 'agama',
                                    'suku', 'telepon', 'email', 'alamat', 'sma_asal', 'nilai_rata', 'univ_asal',
                                    'jurusan', 'nilai_ipk', 'no_str', 'th_str')
                                    ->where('peminatan_id', $value->id)->get();
        }
        // $data = Karir::get()->toArray();
        return Excel::create('laporan-daftar-calon-pegawai-baru', function($excel) use ($data) {
            foreach ($data as $key => $value) {

                $excel->sheet($value['kd'], function($sheet) use ($value) {

                    $sheet->setFreeze('A7');

                    $sheet->setColumnFormat(array(
                        'A' => '0'
                    ));

                    $sheet->mergeCells('A1:J1');
                    $sheet->mergeCells('A2:J2');
                    $sheet->mergeCells('A3:J3');

                    $sheet->cell('A1', function($cell) {
                        $cell->setValue('LAPORAN DATA ADMINISTRASI CALON TENAGA NON PNS RS UNAND 2017');
                        $cell->setFontColor('#004D40');
                        $cell->setFontWeight('bold');
                        $cell->setFontSize(14);
                        $cell->setAlignment('center');
                    });

                    $sheet->cell('A2', function($cell) use($value) {
                        $cell->setValue($value['kd']);
                        $cell->setFontColor('#004D40');
                        $cell->setFontWeight('bold');
                        $cell->setFontSize(13);
                        $cell->setAlignment('center');
                    });

                    $sheet->cell('A3', function($cell) use($value) {
                        $cell->setValue(count($value['data']). " PESERTA");
                        $cell->setFontColor('#004D40');
                        $cell->setFontWeight('bold');
                        $cell->setFontSize(13);
                        $cell->setAlignment('center');
                    });

                    $sheet->setHeight(array(
                        5     =>  15,
                        6     =>  15
                    ));

                    // $sheet->setWidth(array(
                    //     'A'     =>  5,
                    //     'B'     =>  10
                    // ));

                    $sheet->setMergeColumn(array(
                        'columns' => array('A','B','C','D','E','F','G','H','I','J','K'),
                        'rows' => array(
                            array(5,6),
                        ), true
                    ));

                    $sheet->mergeCells('L5:M5');
                    $sheet->mergeCells('N5:P5');
                    $sheet->mergeCells('Q5:R5');
                    $sheet->mergeCells('S5:U5');
                    $sheet->mergeCells('V5:X5');

                    $sheet->appendRow(5, array(
                        'NO IDENTITAS', 'NAMA LENGKAP', 'TMP LAHIR', 'TGL LAHIR', 'GENDER', 'STATUS', 'AGAMA',
                        'SUKU', 'TELEPON', 'EMAIL', 'ALAMAT', 'PENDIDIKAN SMA', '', 'PENDIDIKAN KULIAH', '', '',
                        'NO STR', '', 'PELATIHAN/TRAINING', '', '', 'PENGALAMAN KERJA', '', ''
                    ));

                    $sheet->cell('L6', function($cell) { $cell->setValue('NAMA SMA'); });
                    $sheet->cell('M6', function($cell) { $cell->setValue('NILAI'); });
                    $sheet->cell('N6', function($cell) { $cell->setValue('NAMA UNIVERSITAS'); });
                    $sheet->cell('O6', function($cell) { $cell->setValue('JURUSAN'); });
                    $sheet->cell('P6', function($cell) { $cell->setValue('IPK'); });
                    $sheet->cell('Q6', function($cell) { $cell->setValue('NOMOR'); });
                    $sheet->cell('R6', function($cell) { $cell->setValue('TAHUN'); });
                    $sheet->cell('S6', function($cell) { $cell->setValue('NAMA PELATIHAN'); });
                    $sheet->cell('T6', function($cell) { $cell->setValue('LOKASI'); });
                    $sheet->cell('U6', function($cell) { $cell->setValue('TAHUN'); });
                    $sheet->cell('V6', function($cell) { $cell->setValue('NAMA PERUSAHAAN'); });
                    $sheet->cell('W6', function($cell) { $cell->setValue('JABATAN'); });
                    $sheet->cell('X6', function($cell) { $cell->setValue('LAMA KERJA'); });

                    $dataRow = 7;
                    foreach ($value['data'] as $key => $item) {
                        $sheet->appendRow($dataRow, $item->toArray());

                        $calon = Karir::where('ktp', $item->ktp)->first()->id;
                        $pelatihan = Pelatihan::select('nm_pelatihan', 'lks_pelatihan', 'th_pelatihan')->where('karir_id', $calon)->get()->toArray();
                        $pengalaman = Pengalaman::select('nm_perusahaan', 'jbtn_perusahaan', 'lmkrj_perusahaan')->where('karir_id', $calon)->get()->toArray();

                        $countPelatihan = count($pelatihan);
                        $countPengalaman = count($pengalaman);
                        $yRow = $dataRow;
                        $xRow = $dataRow;

                        foreach ($pelatihan as $key => $value) {
                            $sheet->cell('S'.$xRow, function($cell) use($value) { $cell->setValue($value['nm_pelatihan']); });
                            $sheet->cell('T'.$xRow, function($cell) use($value) { $cell->setValue($value['lks_pelatihan']); });
                            $sheet->cell('U'.$xRow, function($cell) use($value) { $cell->setValue($value['th_pelatihan']); });

                            $xRow = $xRow + 1;
                        }

                        foreach ($pengalaman as $key => $value) {
                            $sheet->cell('V'.$yRow, function($cell) use($value) { $cell->setValue($value['nm_perusahaan']); });
                            $sheet->cell('W'.$yRow, function($cell) use($value) { $cell->setValue($value['jbtn_perusahaan']); });
                            $sheet->cell('X'.$yRow, function($cell) use($value) { $cell->setValue($value['lmkrj_perusahaan']); });

                            $yRow = $yRow + 1;
                        }

                        $addRow = max($countPelatihan, $countPengalaman);

                        if ($addRow <= 1) {
                            $dataRow = $dataRow + 1;
                        } else {
                            $dataRow = $dataRow + $addRow;
                        }
                    }

                    $sheet->cells('A5:K5', function($cells) {
                        $cells->setAlignment('center');
                        $cells->setValignment('center');
                        $cells->setBackground('#004D40');
                        $cells->setFontColor('#ffffff');
                        $cells->setFontWeight('bold');
                        $cells->setFontSize(9);
                    });

                    $sheet->cells('L5:V5', function($cells) {
                        $cells->setAlignment('center');
                        $cells->setValignment('center');
                        $cells->setBackground('#004D40');
                        $cells->setFontColor('#ffffff');
                        $cells->setFontWeight('bold');
                        $cells->setFontSize(9);
                    });

                    $sheet->cells('L6:X6', function($cells) {
                        $cells->setAlignment('center');
                        $cells->setValignment('center');
                        $cells->setBackground('#004D40');
                        $cells->setFontColor('#ffffff');
                        $cells->setFontWeight('bold');
                        $cells->setFontSize(9);
                    });

                    $sheet->cells('A7:X'.$dataRow, function($cells) {
                        $cells->setAlignment('center');
                        $cells->setValignment('center');
                        $cells->setFontSize(8);
                    });

                    for ($i=7; $i <= $dataRow ; $i++) {
                        $sheet->setHeight([$i => 15]);
                    }

                    $sheet->setAutoSize(true);
                    $sheet->setBorder('A5:X'.$dataRow, 'thin');

                });

            }
        })->download('xls');
    }
}

// red #FB483A
// yellow #FF9600
//  green #2B982B
