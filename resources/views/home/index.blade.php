@extends('template.index')

@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            {{-- <h2>Selamat Datang di Anbiotek Storage</h2> --}}
        </div>
        
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="body">
                        <p class="text-center"><strong>Grafik Jumlah Transaksi Penjualan & Pembelian Produk <br> Pada Tahun {{ date('Y') }}</strong></p>
                        <canvas id="grafikPenjualan" width="100" height="100"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="body">
                        <p class="text-center"><strong>Grafik Nominal Penjualan & Pembelian Produk <br> Pada Tahun {{ date('Y') }} (dalam juta rupiah)</strong></p>
                        <canvas id="grafikPembelian" width="100" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="body">
                        <p class="text-center"><strong>10 Produk Yang Paling Banyak Terjual <br> Pada Tahun {{ date('Y') }}</strong></p>
                        <table class="table table-hover dashboard-task-infos">
                            <thead>
                                <tr>
                                    <th>No Katalog</th>
                                    <th>Nama Produk</th>
                                    <th>Kategori</th>
                                    <th>Total</th>
                                    <th>Stok</th>
                                    <th>Satuan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($collectBarang as $key => $value)
                                    <tr>
                                        <td>{{ $value['kode'] }}</td>
                                        <td>{{ $value['nmbarang'] }}</td>
                                        <td>{{ $value['nmkategori'] }}</td>
                                        <td>{{ $value['total'] }}</td>
                                        <td>{{ $value['stock'] }}</td>
                                        <td>{{ $value['satuan'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
    
    <script type="text/javascript">
        
        var ctxPenjualan = document.getElementById("grafikPenjualan").getContext('2d');
        var grafikPenjualan = new Chart(ctxPenjualan, {
            type: 'horizontalBar',
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"],
                datasets: [{
                    label: 'Trans. Penjualan',
                    data: {{ $arrayPenjualan }},
                    backgroundColor:
                        'rgba(54, 162, 235, 0.2)'
                    ,
                    borderColor: 
                        'rgba(54, 162, 235, 1)'
                    ,
                    borderWidth: 1
                }, {
                    label: 'Trans. Pembelian',
                    data: {{ $arrayPembelian }},
                    backgroundColor:
                        'rgba(255, 99, 132, 0.2)'
                    ,
                    borderColor: 
                        'rgba(255,99,132,1)'
                    ,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });

        var ctxPembelian = document.getElementById("grafikPembelian").getContext('2d');
        var grafikPembelian = new Chart(ctxPembelian, {
            type: 'horizontalBar',
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"],
                datasets: [{
                    label: 'Penjualan',
                    data: {{ $nominalPenjualan }},
                    backgroundColor:
                        'rgba(54, 162, 235, 0.2)'
                    ,
                    borderColor: 
                        'rgba(54, 162, 235, 1)'
                    ,
                    borderWidth: 1
                }, {
                    label: 'Pembelian',
                    data: {{ $nominalPembelian }},
                    backgroundColor:
                        'rgba(255, 99, 132, 0.2)'
                    ,
                    borderColor: 
                        'rgba(255,99,132,1)'
                    ,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });

    </script>

@endpush
