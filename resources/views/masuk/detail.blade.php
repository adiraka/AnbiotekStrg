@extends('template.index')

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Barang Masuk</h2>
            </div>
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Detail Barang Masuk</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="{{route('tambahBarang')}}">Tambah Barang</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body" id="section-to-print">
                            @include('template.partials.alert')
                            <div class="row">
                                <div class="col-md-3 col-sm-6 col-xs-6">
                                    <p>Nomor Bon </p>
                                    <p>Nama Supplier </p>
                                    <p>Tanggal </p>
                                    <p>Keterangan</p>
                                </div>
                                <div class="col-md-6 col-xs-6 col-xs-6">
                                    <p>: {{ $masuk->nobon }}</p>
                                    <p>: {{ $masuk->supplier }}</p>
                                    <p>: {{ $masuk->tglmasuk }}</p>
                                    <p>: {{ $masuk->ket }}</p>
                                </div>
                            </div>
                            <p>Detail Transaksi :</p>
                            <table class="table table-bordered table-striped table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Qty</th>
                                        <th>Harga</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detailMasuk as $key => $detail)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $detail->barang_kode }}</td>
                                            <td>{{ $detail->barang->nmbarang }}</td>
                                            <td>{{ $detail->stokmasuk." ".$detail->barang->satuan->nmsatuan }}</td>
                                            <td>Rp. {{ number_format($detail->harga, 2, ".", ".") }}</td>
                                            <td>Rp. {{ number_format($detail->subtot, 2, ".", ".") }}</td>
                                        </tr>
                                    @endforeach
                                        <tr>
                                            <td><b>#</b></td>
                                            <td colspan="4"><b>TOTAL</b></td>
                                            <td><b>Rp. {{ number_format($masuk->totbay, 2, ".", ".") }}</b></td>
                                        </tr>
                                </tbody>
                            </table>

                            <a href="javascript:window.print()" class="btn btn-success">Print</a>
                            <a href="{{ route('lihatMasuk') }}" class="btn btn-primary">Kembali</a>
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
