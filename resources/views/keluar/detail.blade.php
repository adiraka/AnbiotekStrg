@extends('template.index')

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Stok Keluar</h2>
            </div>
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Detail Transaksi</h2>
                        </div>
                        <div class="body" id="section-to-print">
                            @include('template.partials.alert')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-6 col-xs-6">
                                            <p>Nomor Faktur </p>
                                            <p>Nama/Instansi </p>
                                            <p>Telepon</p>
                                            <p>Alamat</p>
                                        </div>
                                        <div class="col-md-8 col-xs-6 col-xs-6">
                                            <p>: {{ $keluar->nobon }}</p>
                                            <p>: {{ $keluar->pelanggan->nmpelanggan }}</p>
                                            <p>: {{ $keluar->pelanggan->telepon }}</p>
                                            <p>: {{ $keluar->pelanggan->alamat }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-6 col-xs-6">
                                            <p>Tgl. Faktur </p>
                                            <p>Nama Admin </p>
                                            <p>Stat. Pembayaran</p>
                                            <p>Tgl. Pelunasan</p>
                                        </div>
                                        <div class="col-md-8 col-xs-6 col-xs-6">
                                            <p>: {{ $keluar->tglkeluar }}</p>
                                            <p>: {{ $keluar->user->first_name.' '.$keluar->user->last_name }}</p>
                                            <p>: {{ $keluar->status }}</p>
                                            <p>: {{ $keluar->tgllunas }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <p>Detail Produk :</p>
                            <table class="table table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>No Katalog</th>
                                        <th>Nama Produk</th>
                                        <th>Merek</th>
                                        <th>Qty</th>
                                        <th>Harga</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detailKeluar as $key => $detail)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $detail->barang_kode }}</td>
                                            <td>{{ $detail->barang->nmbarang }}</td>
                                            <td>{{ $detail->barang->merk->nmmerk }}</td>
                                            <td>{{ $detail->stokeluar." ".$detail->barang->satuan->nmsatuan }}</td>
                                            <td align="right"><span class="pull-left">IDR</span>{{ number_format($detail->harga, 2) }}</td>
                                            <td align="right"><span class="pull-left">IDR</span>{{ number_format($detail->subtot, 2) }}</td>
                                        </tr>
                                    @endforeach
                                        <tr>
                                            <td><b>#</b></td>
                                            <td colspan="5"><b>Total Bayar</b></td>
                                            <td align="right"><b><span class="pull-left">IDR</span>{{ number_format($keluar->totbay, 2) }}</b></td>
                                        </tr>
                                </tbody>
                            </table>
                            <p>NB : {{ $keluar->ket }}</p><hr>
                            <a href="javascript:window.print()" class="btn btn-primary">Print</a>
                            <a href="{{ route('lihatMasuk') }}" class="btn btn-default">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('styles')

    <style type="text/css">
    @media print {
        body * {
            visibility: hidden;
        }
        #section-to-print * {
            visibility: visible;
        }
        #section-to-print {
            position: absolute;
            left: 0;
            top: 0;
        }
    }
    </style>

@endpush
