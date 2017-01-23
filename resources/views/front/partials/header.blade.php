<section id="header" class="header">
	<div class="bg-blue">
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
			<div class="row">
				<div class="header-info">
					<div class="banner-text text-center">
						<h1 class="white">@yield('page-header')</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>