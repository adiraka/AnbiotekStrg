@extends('template.index')

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Merk Produk</h2>
            </div>
            <div class="row clearfix">
                <div class="col-md-12">
                    @include('template.partials.alert')
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="header">
                            <h2>Tambah Merk</h2>
                        </div>
                        <div class="body">
                            @include('template.partials.formalert')
                            <form class="form-horizontal" action="" id="form_validation" method="post">
                                <input type="hidden" name="_token" value="{{ Session::token() }}">
                                <div class="row clearfix">
                                    <div class="col-lg-4 col-md-4 col-sm-3 col-xs-5 form-control-label">
                                        <label for="nmsatuan">Nama Merk</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-9 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="nmmerk" class="form-control" value="" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-offset-4 col-md-offset-4 col-sm-offset-3 col-xs-offset-5">
                                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <div class="card">
                        <div class="header">
                            <h2>Tabel Data Merk</h2>
                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped table-hover table-merk dataTable display responsive no-wrap" width="100%">
                                <thead>
                                    <tr>
                                        <th>ID Satuan</th>
                                        <th>Nama Satuan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('styles')

    <link href="{{asset('css/dataTables.bootstrap.css')}}" rel="stylesheet" />
    <link href="{{asset('css/responsive.bootstrap.min.css')}}" rel="stylesheet" />

@endpush

@push('scripts')

    <script src="{{asset('js/jquery.validate.js')}}"></script>
    <script src="{{asset('js/form-validation.js')}}"></script>
    <script src="{{asset('js/datatables.min.js')}}"></script>
    <script src="{{asset('js/dataTables.bootstrap.js')}}"></script>
    <script src="{{asset('js/datatables/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('js/datatables/responsive.bootstrap.min.js')}}"></script>
    <script src="{{asset('js/mydatatable.js')}}"></script>

@endpush
