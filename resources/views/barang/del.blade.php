@extends('template.index')

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Barang</h2>
            </div>
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Hapus Barang</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Lihat Barang</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            @include('template.partials.alert')
                            @include('template.partials.formalert')
                            <form class="form-horizontal" action="" id="form_validation" method="post">
                                <input type="hidden" name="_token" value="{{ Session::token() }}">
                                <input type="hidden" name="kode" value="{{ $barang->kode }}">
                                <input type="hidden" name="_method" value="DELETE">
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="nmkategori">Peringatan :</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <h5>Apakah anda yakin ingin menghapus data " {{ $barang->kode . ' -> ' . $barang->nmbarang }} " berikut?</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                        <button type="submit" class="btn btn-lg btn-danger m-t-15 waves-effect">HAPUS</button>&nbsp;
                                        <a href="{{ route('lihatKategori') }}" class="btn btn-default m-t-15 waves-effect">BATAL</a>
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



@endpush

@push('scripts')

    <script src="{{asset('js/jquery.validate.js')}}"></script>
    <script src="{{asset('js/form-validation.js')}}"></script>

@endpush
