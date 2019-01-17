<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/style.css') }}" rel="stylesheet">
	<title>@yield('title')</title>
</head>
<body>
	<header>
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
	</header>
	@yield('body')
	<footer>

	</footer>
	<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
