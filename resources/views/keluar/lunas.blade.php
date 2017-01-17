@extends('template.index')

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Kategori Produk</h2>
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
                            <h2>Tambah Kategori</h2>
                        </div>
                        <div class="body">
                            @include('template.partials.formalert')
                            <form class="form-horizontal" action="" id="form_validation" method="post">
                                <input type="hidden" name="_token" value="{{ Session::token() }}">
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="id" value="{{ $keluar->id }}">
                                <div class="row clearfix">
                                    <div class="col-lg-4 col-md-4 col-sm-3 col-xs-5 form-control-label">
                                        <label for="nobon">No Faktur</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-9 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="nobon" class="form-control" placeholder="Nomor Faktur" value="{{ $keluar->nobon }}" required readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-4 col-md-4 col-sm-3 col-xs-5 form-control-label">
                                        <label for="status">Pembayaran</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-9 col-xs-7">
                                        <div class="form-group">
                                            <div class="">
                                                <select class="form-control status" id="status" name="status" required>
                                                    <option value="{{ $keluar->status }}" selected>{{ $keluar->status }}</option>
                                                    <option value="Lunas">Lunas</option>
                                                    <option value="Belum Lunas">Belum Lunas</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-4 col-md-4 col-sm-3 col-xs-5 form-control-label">
                                        <label for="tgllunas">Tgl Pelunasan</label>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-9 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="tgllunas" name="tgllunas" class="form-control datepicker" placeholder="Tanggal Pelunasan" value="{{ $keluar->tgllunas }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-offset-4 col-md-offset-4 col-sm-offset-3 col-xs-offset-5">
                                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">Simpan</button>&nbsp;
                                        <a href="{{ route('lihatMasuk') }}" class="btn btn-default m-t-15 waves-effect">Batal</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('styles')
    
    <link href="{{asset('css/bootstrap-material-datetimepicker.css')}}" rel="stylesheet" />
    <link href="{{asset('css/select2.css')}}" rel="stylesheet" />

@endpush

@push('scripts')

    <script src="{{asset('js/jquery.validate.js')}}"></script>
    <script src="{{asset('js/form-validation.js')}}"></script>
    <script src="{{asset('js/moment.js')}}"></script>
    <script src="{{asset('js/bootstrap-material-datetimepicker.js')}}"></script>
    <script src="{{asset('js/select2.js')}}"></script>
    <script>
        $(function () {
            $('.datepicker').bootstrapMaterialDatePicker({
                format: 'YYYY/MM/DD',
                clearButton: true,
                time: false,
                switchOnClick: true
            });
            $('.status').select2({
                width: "100%",
            });
            $('#status').on("change", function() {
                if ($('#status').val() == 'Lunas') {
                    $('#tgllunas').removeAttr('readonly');
                } else if ($('#status').val() == 'Belum Lunas') {
                    $('#tgllunas').val(null);
                    $('#tgllunas').attr('readonly', 'readonly'); 
                }
            });
        });
    </script>

@endpush
