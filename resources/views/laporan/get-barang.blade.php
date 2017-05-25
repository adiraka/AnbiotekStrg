@extends('template.index')

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Laporan Stok Produk</h2>
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
                        <div class="header">
                            <h2>LAPORAN PER KATEGORI</h2>
                        </div>
                        <div class="body">
                            <a href="{{ route('laporanExcel', ['kategori']) }}" class="btn btn-block btn-success">Export Laporan ke Format Excel</a>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="header">
                            <h2>LAPORAN PER MERK</h2>
                        </div>
                        <div class="body">
                            <a href="{{ route('laporanExcel', ['merk']) }}" class="btn btn-block btn-success">Export Laporan ke Format Excel</a>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="header">
                            <h2>LAPORAN KESELURUHAN</h2>
                        </div>
                        <div class="body">
                            <a href="{{ route('laporanExcel', ['keseluruhan']) }}" class="btn btn-block btn-success">Export Laporan ke Format Excel</a>
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
