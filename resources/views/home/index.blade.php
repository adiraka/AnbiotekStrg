@extends('template.index')

@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Selamat Datang</h2>
        </div>
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <div class="card">
                    <div class="body">
                        <p class="text-center"><strong>TOTAL PRODUK</strong></p>
                        <div class="row">
                            <div class="col-md-6 text-center">
                                KATEGORI
                            </div>
                            <div class="col-md-6 text-center">
                                TOTAL
                            </div>
                        </div>
                        @foreach ($totalProduk as $item)
                            <div class="row">
                                <div class="col-md-6 text-center">
                                    {{ $item['nmkategori'] }}
                                </div>
                                <div class="col-md-6 text-center">
                                    {{ $item['jmlhproduk'] }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <div class="card">
                    <div class="body">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fuga voluptatibus dolorum possimus nisi quos error eaque aliquam, modi temporibus amet facere sapiente perferendis ratione alias cum rerum ad id expedita.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <div class="card">
                    <div class="body">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fuga voluptatibus dolorum possimus nisi quos error eaque aliquam, modi temporibus amet facere sapiente perferendis ratione alias cum rerum ad id expedita.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
