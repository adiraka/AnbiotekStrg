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
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <div class="card">
                        <div class="body">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fuga voluptatibus dolorum possimus nisi quos error eaque aliquam, modi temporibus amet facere sapiente perferendis ratione alias cum rerum ad id expedita.
                            </p>
                            <p>
                                <button>
                                
                                </button>
                            </p>
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
