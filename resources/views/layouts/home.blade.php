<!DOCTYPE html>
<html lang="en" class="no-js">
	<!-- Head -->
	<head>
		<title>{{ $title ?? 'SiKEMA | Sistem Kehadiran Mahasiswa' }}</title>

		<!-- Meta -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="x-ua-compatible" content="ie=edge">

		<!-- Favicon -->
		<link rel="shortcut icon" href="favicon.png" type="image/x-icon">

		<!--  Social tags -->
		<meta name="keywords" content="Awesome Dashboard UI Kit, Bootstrap, Template, Theme, Freebies, MIT license, Free, Download">
		<meta name="description" content="Awesome Dashboard UI Kit crafted by Htmlstream">
		<meta name="author" content="htmlstream.com">

		<!-- Schema.org -->
		<meta itemprop="name" content="Awesome Dashboard UI Kit">
		<meta itemprop="description" content="Awesome Dashboard UI Kit crafted by Htmlstream">
		<meta itemprop="image" content="assets/img-temp/aduik-preview.png">

		<!-- Twitter Card -->
		<meta name="twitter:card" content="product">
		<meta name="twitter:site" content="@htmlstream">
		<meta name="twitter:title" content="Awesome Dashboard UI Kit">
		<meta name="twitter:description" content="Awesome Dashboard UI Kit crafted by Htmlstream">
		<meta name="twitter:creator" content="@htmlstream">
		<meta name="twitter:image" content="assets/img-temp/aduik-preview.png">

		<!-- Open Graph -->
		<meta property="og:type" content="website">
		<meta property="og:site_name" content="Htmlstream">
		<meta property="og:title" content="Awesome Dashboard UI Kit">
		<meta property="og:description" content="Awesome Dashboard UI Kit crafted by Htmlstream">
		<meta property="og:url" content="https://htmlstream.com/preview/awesome-dashboard-ui-kit/">
		<meta property="og:locale" content="en_US">
		<meta property="og:image" content="assets/img-temp/aduik-preview.png">
		<meta property="og:image:secure_url" content="assets/img-temp/aduik-preview.png">

		<!-- Web Fonts -->
		<!-- <link href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet"> -->

		<!-- Components Vendor Styles -->
		<link rel="stylesheet" href="{{ asset('assets/vendor/themify-icons/themify-icons.css') }}">

		<!-- Theme Styles -->
		<link rel="stylesheet" href="{{ asset('assets/css/theme.css') }}">
	</head>
	<!-- End Head -->

	<!-- Body -->
	<body>
		<!-- Main -->
        @yield('content')
		<!-- End Main -->
	</body>
	<!-- End Body -->
</html>