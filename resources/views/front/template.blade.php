<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PT. Andalas Bioteknologi Saiyo</title>
	<meta name="description" content="Bergerak dalam penyediaan bahan-bahan dan alat terkait dengan biologi molekuler, imunologi, kultur sel, diagnostik kedokteran dan untuk kepentingan pelayanan di bidang kesehatan dan penelitian, seperti penyediaankebutuhan bahan/reagen dan alat untuk pusat layanan kesehatan (RS, praktek dokter, bidan, dan STIKES).">
	<meta name="keywords" content="bioteknologi, laboratorium, anbiotek, saiyo, andalas, bioteknologi, kimia, rs, rumah sakit, sakit, rumah, labor, bio, teknologi, elisa, kit, reagen, plastic, ware, plasticware, padang, sumbar, perlengkapan, alat">

	<link href="favicon.ico" rel="shortcut icon" />

	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans|Raleway|Candal">
	<link rel="stylesheet" type="text/css" href="{{ asset('front/css/font-awesome.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('front/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('front/css/animate.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('front/css/style.css') }}">
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
	
	@yield('content')
	@include('front.partials.footer')
	
	<script src="{{ asset('front/js/jquery.min.js') }}"></script>
	<script src="{{ asset('front/js/jquery.easing.min.js') }}"></script>
	<script src="{{ asset('front/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('front/js/custom.js') }}"></script>

</body>
</html>