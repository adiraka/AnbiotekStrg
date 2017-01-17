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
                            <h2>Data Stok Keluar</h2>
                        </div>
                        <div class="body">
                            @include('template.partials.alert')
                            <table class="table table-bordered table-striped table-hover table-keluar dataTable display responsive no-wrap" width="100%">
                                <thead>
                                    <tr>
                                        <th>No faktur</th>
                                        <th>Pelanggan</th>
                                        <th>Tgl Faktur</th>
                                        <th>Status</th>
                                        <th>Tgl Lunas</th>
                                        <th>Total Bayar</th>
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

    <script src="{{asset('js/jquery.dataTables.js')}}"></script>
    <script src="{{asset('js/dataTables.bootstrap.js')}}"></script>
    <script src="{{asset('js/datatables/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('js/datatables/responsive.bootstrap.min.js')}}"></script>
    <script src="{{asset('js/datatables/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('js/datatables/buttons.html5.min.js')}}"></script>
    <script src="{{asset('js/datatables/jszip.min.js')}}"></script>
    <script src="{{asset('js/datatables/pdfmake.min.js')}}"></script>
    <script src="{{asset('js/datatables/vfs_fonts.js')}}"></script>
    <script src="{{asset('js/mydatatable.js')}}"></script>

@endpush
