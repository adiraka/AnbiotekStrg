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
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="header text-center">
                            <h2>Laporan Stok Masuk Per Bulan</h2>
                        </div>
                        <div class="body">
                            <div class="form-group">
                                <div class="form-line">
                                    <select class="form-control" name="tahun-laporan-bulanan" id="tahun-laporan-bulanan">
                                        <option value="" disabled selected>-- Pilih Tahun --</option>
                                        <option value="2017">2017</option>
                                        <option value="2018">2018</option>
                                        <option value="2019">2019</option>
                                    </select>
                                </div>
                            </div>
                            <a href="#" target="_blank" id="btn-laporan-bulanan" class="btn btn-block btn-success">Download Laporan (.xls)</a>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="header text-center">
                            <h2>Laporan Stok Masuk Per Distributor</h2>
                        </div>
                        <div class="body">
                            <div class="form-group">
                                <div class="form-line">
                                    <select class="form-control" name="tahun-laporan-distributor" id="tahun-laporan-distributor">
                                        <option value="" disabled selected>-- Pilih Tahun --</option>
                                        <option value="2017">2017</option>
                                        <option value="2018">2018</option>
                                        <option value="2019">2019</option>
                                    </select>
                                </div>
                            </div>
                            <a href="#" target="_blank" id="btn-laporan-distributor" class="btn btn-block btn-success">Download Laporan (.xls)</a>
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
    
    <script>
        $(function(){
            $('#tahun-laporan-bulanan').on('change', function(){
                var tahun = $(this).val();
                var new_url = '/admin/laporan/masuk/bulanan/' + tahun;
                $('#btn-laporan-bulanan').attr('href', new_url);
            });

            $('#tahun-laporan-distributor').on('change', function(){
                var tahun = $(this).val();
                var new_url = '/admin/laporan/masuk/distributor/' + tahun;
                $('#btn-laporan-distributor').attr('href', new_url);
            });
        });
    </script>

@endpush
