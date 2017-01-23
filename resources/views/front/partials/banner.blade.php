<section id="banner" class="banner">
	<div class="bg-color">
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<div class="col-md-12">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="#"><img src="{{ asset('front/img/logo3.png') }}" class="img-responsive" style="width: 140px; margin-top: -16px;"></a>
					</div>
					<div class="collapse navbar-collapse navbar-right" id="myNavbar">
						<ul class="nav navbar-nav">
							<li><a href="{{ route('frontBeranda') }}">BERANDA</a></li>
							<li><a href="{{ route('frontProduk') }}">PRODUK</a></li>
							<li><a href="{{ route('frontTentang') }}">TENTANG KAMI</a></li>
							<li class=""><a href="{{ route('getBlog') }}">BLOG</a></li>
						</ul>
					</div>
				</div>
			</div>
		</nav>
		<div class="container">
			<div id="myCarousel" class="carousel container slide carousel-fade">
				<div class="carousel-inner">
					<div class="active item one animated fadeIn"></div>
					<div class="item two"></div>
					<div class="item three"></div>
				</div>
			</div>
			<div class="row">
				<div class="banner-info">
					<div class="banner-logo text-center">
						<img src="{{ asset('front/img/logo2.png') }}" style="height: 150px;" class="img-responsive animated bounceInDown">
					</div>
					<div class="banner-text text-center">
						<h1 class="white">PT. Andalas Bioteknologi Saiyo</h1>
						<p><b>" MENUJU KEMANDIRIAN UNTUK KESEJAHTERAAN UMAT "</b></p>
						<a href="#service" class="btn btn-appoint hidden-xs hidden-sm">MULAI</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>