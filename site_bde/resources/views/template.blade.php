<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-tofit=no">
	<!-- Utilise Bootstrap -->
	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
	<!-- Utilise FontAwesome -->
	<link href="{{ asset('fonts/fontawesome/css/all.min.css') }}" rel="stylesheet">
	<!-- Utilise CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
	<!-- Utilise LESS -->
	<link rel="stylesheet/less" type="text/css" href="{{ asset('less/styles.less') }}">
	<title>@yield('title')</title>
</head>
<body>
	<header>
		<div class="inner">
			<nav class="navbar navbar-expand-lg navbar">
				<a class="navbar-brand" href="/">BDE CESI</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNav">
					<ul class="navbar-nav">
						<li class="nav-item">
							<a class="nav-link" href="{{ route('activities') }}">Activities</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{ route('ideas') }}">Ideas</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{ route('shop') }}">Shop</a>
						</li>
					</ul>
				</div>
				
				<ul class="navbar-nav" style="float : right;">
					<li class="nav-item">
						<a class="nav-link" href="{{ route('register') }}">Sign up</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="{{ route('login') }}">Sign in</a>
					</li>
				</ul>
			</nav>
		</div>
	</header>
	@yield('body')
	<footer>
		<div class="inner">
			<div class="footer-menu">
				<div class="footer-bloc">
					<div class="footer-title"></div>
					<ul>
						<li></li>
						<li></li>
						<li></li>
					</ul>
				</div>
			</div>
		</div>
	</footer>
	<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/less.js/3.9.0/less.min.js" ></script>
</body>
</html>
