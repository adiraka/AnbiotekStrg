@extends('template.index')

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Laporan Stok Masuk</h2>
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
                            <h2>LAPORAN PER DISTRIBUTOR</h2>
                        </div>
                        <div class="body">
                            <a href="{{ route('laporanStokMasukExcel', ['distributor']) }}" class="btn btn-block btn-success">Export Laporan ke Format Excel</a>
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
