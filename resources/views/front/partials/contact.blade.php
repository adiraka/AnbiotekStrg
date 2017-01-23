<section id="contact" class="section-padding">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2 class="ser-title">Hubungi Kami</h2>
				<hr class="botm-line">
			</div>
			<div class="col-md-4 col-sm-4">
				<h3>Kontak Info</h3>
				<div class="space"></div>
				<p><i class="fa fa-map-marker fa-fw pull-left fa-2x"></i>Komp. Cendana Mata Air Thp. VIII Blok A/4 Koto Baru Nan XX, Padang 25171</p>
				<div class="space"></div>
				<p><i class="fa fa-envelope-o fa-fw pull-left fa-2x"></i>bioteknologiandalas@yahoo.co.id</p>
				<div class="space"></div>
				<p><i class="fa fa-phone fa-fw pull-left fa-2x"></i>+62 751 64652</p>
			</div>
			<div class="col-md-8 col-sm-8 marb20">
				<div class="contact-info">
					<h3 class="cnt-ttl">Ingin melakukan pemesanan ? Atau beberapa pertanyaan ?</h3>
					<div class="space"></div>
					@if (Session::has('sukses'))
						<div class="alert alert-info alert-dismissible" role="alert""><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Terima Kasih, pesan anda telah terkirim!</div>
					@endif
					<div id="errormessage"></div>
					<form action="{{ route('postKontak') }}" method="post" role="form" class="contactForm">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group">
							<input type="text" name="nama" class="form-control br-radius-zero" id="name" placeholder="Nama Lengkap" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
							<div class="validation"></div>
						</div>
						<div class="form-group">
							<input type="email" class="form-control br-radius-zero" name="email" id="email" placeholder="Alamat Email" data-rule="email" data-msg="Please enter a valid email" />
							<div class="validation"></div>
						</div>
						<div class="form-group">
							<input type="text" class="form-control br-radius-zero" name="judul" id="subject" placeholder="Judul" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
							<div class="validation"></div>
						</div>
						<div class="form-group">
							<textarea class="form-control br-radius-zero" name="pesan" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Pesan"></textarea>
							<div class="validation"></div>
						</div>

						<div class="form-action">
							<button type="submit" class="btn btn-form">Kirim Pesan</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>