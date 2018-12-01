@extends('template.index')

@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Selamat Datang di Anbiotek Storage</h2>
        </div>
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="body">
                        <p class="text-center"><strong>Grafik Penjualan Produk Pada Tahun {{ date('Y') }}</strong></p>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="body">
                        <p class="text-center"><strong>Grafik Pembelian Produk Pada Tahun {{ date('Y') }}</strong></p>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
