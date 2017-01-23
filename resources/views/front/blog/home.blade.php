@extends('front.template')

@section('page-header')
	B L O G
@endsection

@section('content')

	@include('front.partials.header')

	<section id="service" class="section-padding">
		<div class="container">
			<div class="row">
				<div class="col-md-9 col-sm-8 col-xs-12">
					@foreach ($blog as $value)
						<div style="visibility: visible; margin-bottom: 30px;" class="col-sm-12 more-features-box">
							<div class="more-features-box-text">
								<div class="more-features-box-text-icon">
									<i class="fa fa-angle-right" aria-hidden="true"></i>
								</div>
								<div class="more-features-box-text-description">
									<h3 class="blog-title">{{ $value->judul }} <small>{{ $value->created_at }}</small></h3>
									<p class="blog-desc">{!! str_limit($value->teks, 400) !!}</p>
									<a href="#" class="btn btn-sm btn-primary pull-right">Selengkapnya...</a>
								</div>
							</div>
						</div>
					@endforeach
				</div>
				<div class="col-md-3 col-sm-4 col-xs-12">
					<div class="section-title">
						<h2 class="head-title lg-line">Artikel Terpopuler</h2>
						<hr class="botm-line">
						<p class="sec-para">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo, natus vero assumenda autem quos sunt sint eligendi iste quisquam sit, explicabo. Quae molestias aperiam, minima cum, natus adipisci numquam ad!</p>
					</div>
				</div>
			</div>
		</div>
	</section>

@endsection