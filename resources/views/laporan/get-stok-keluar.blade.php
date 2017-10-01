@extends('template.index')

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Laporan Stok Keluar</h2>
                <br>
            </div>
            <div class="row clearfix">
                <div class="col-md-12">
                    @include('template.partials.alert')
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="header text-center">
                            <h2>Laporan Stok Keluar Per Pelanggan</h2>
                        </div>
                        <div class="body">
                            <a href="{{ route('laporanStokKeluarExcel', ['pelanggan']) }}" class="btn btn-block btn-success">Download Laporan (.xls)</a>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="header text-center">
                            <h2>Laporan Stok Keluar Per Bulan</h2>
                        </div>
                        <div class="body">
                            <a href="{{ route('laporanStokKeluarExcel', ['bulanan']) }}" class="btn btn-block btn-success">Download Laporan (.xls)</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection

@push('styles')

@endpush

@push('scripts')

@endpush
