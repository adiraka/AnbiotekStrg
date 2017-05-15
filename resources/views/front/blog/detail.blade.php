@extends('front.template')

@section('page-header')
	{{ $blogDetail->judul }}
@endsection

@section('content')

	@include('front.partials.header')

	<section id="service" class="section-padding">
		<div class="container">
			<div class="row">
				<div class="col-md-9 col-sm-8 col-xs-12">
					<div style="visibility: visible; margin-bottom: 30px;" class="col-sm-12 more-features-box">
						<div class="more-features-box-text">
							{{-- <div class="more-features-box-text-icon">
								<i class="fa fa-angle-right" aria-hidden="true"></i>
							</div> --}}
							<div class="more-features-box-text-description">
								<h3 class="blog-title"> <small>{{ $blogDetail->created_at->format("d M Y | H:i") }} | by Admin</small></h3>
								<p class="blog-desc">{!! $blogDetail->teks !!}</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-4 col-xs-12">
					<div class="section-title">
						<h2 class="head-title lg-line">Artikel Terpopuler</h2>
						<hr class="botm-line">
						<p class="sec-para"></p>
					</div>
				</div>
			</div>
		</div>
	</section>

@endsection