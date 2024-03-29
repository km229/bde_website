<?php 
if(!isset($_SESSION)){
	session_start();
} 
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-tofit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- Utilise Bootstrap -->
	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
	<!-- Utilise FontAwesome -->
	<link href="{{ asset('fonts/fontawesome/css/all.min.css') }}" rel="stylesheet">
	<!-- Utilise Polices -->
	<link href="{{ asset('css/fonts.css') }}" rel="stylesheet" type="text/css">
	<!-- Utilise CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
	<!-- Utilise LESS -->
	<!--<link rel="stylesheet/less" type="text/css" href="{{ asset('less/styles.less') }}">-->
	@yield('link')

	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>@yield('title') | BDE CESI</title>
</head>
<body>

	<header>
		<div class="inner">
			<div class="logo">
				<a href="/"><img src='{{ asset('img/logo.jpg') }}' alt="Logo"></a>
			</div>
			<nav>
				<div style="display: flex; height: 100%">
					<div class="burger">
						<?php
						if(sizeof($_SESSION)>0){
							$table_notif = DB::table('notifications')->where('member_id_fk', $_SESSION['id'])->get();
						}
						?>
						<button type="button" class="notif" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="notif">
							<i class="fas fa-bell"></i>
							<?php if(sizeof($_SESSION)>0){if(sizeof($table_notif) > 0) echo'<span class="badge badge-light">'.sizeof($table_notif) .'</span>';}?>
						</button>
						<div id="notif_dropdown" class="dropdown-menu">
							<?php

							if(isset($table_notif)){
								if(sizeof($table_notif) > 0){
									if(sizeof($_SESSION)>0){
										foreach ($table_notif as $notif) {
											echo($notif->notif_desc.'<div class="dropdown-divider" ></div>');
										}
									}
								}else{
									echo 'You don\'t have notifications';
								}
							}else{
								echo 'You don\'t have notifications';
							}
							echo '</div>';
							?>
							<i class="fas fa-bars"></i>
						</div>
						<ul>
							<li class="level1"><a href="/activities">Activities</a></li>
							<li class="level1"><a href="/ideas">Ideas</a></li>
							<li class="level1"><a href="/shop">Shop</a></li>
							<li class="level2">
								<?php
								if(isset($_SESSION["name"])){
									echo "Hello ".$_SESSION["name"];
								} else {
									echo "My account";
								}
								?>
								<ul>
									<?php
									if(isset($_SESSION["name"])){
										echo "<li><a href=\"/account/orders\">My orders</a></li>"
										."<li><a href=\"/account\">My informations</a></li>"
										. "<li><a href=\"/logout\">Logout</a></li>";
									} else {
										echo "<li><a href=\"/register\">Sign up</a></li>"
										."<li><a href=\"/login\">Sign in</a></li>";
									}
									?>
								</ul>
							</li>
							<li class="level1"><a href="/shop/cart">Cart</a></li>
						</ul>
					</nav>
				</div>
			</header>
			<main>
				<div class="inner">
					@yield('body')    
					<?php
					if(session('error')){
						echo '<div class="alert alert-danger">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>'.session('error').'</strong></div>';
					} if(session('success')){
						echo '
						<div class="alert alert-success">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>'.session('success').'</strong></div>';
					}
					?>
				</div>
			</main>

			<footer>
				<div class="inner">
					<div class="footer-menu">
						<div class="footer-bloc">
							<div class="footer-title">Idea box</div>
							<ul>
								<li><a href="/ideas">Check ideas</a></li>
								<li><a href="/ideas/create">New idea</a></li>
							</ul>
						</div>
						<div class="footer-bloc">
							<div class="footer-title">Activities</div>
							<ul>
								<li><a href="/activities">Check activities</a></li>
								<li><a href="/activities/create">New activity</a></li>
							</ul>
						</div>
						<div class="footer-bloc">
							<div class="footer-title">Shop</div>
							<ul>
								<li><a href="/shop">Check products</a></li>
								<li><a href="/shop/cart">Check my cart</a></li>
							</ul>
						</div>
						<div class="footer-bloc">
							<div class="footer-title">Follow us</div>
							<ul class="social">
								<li><a href=""><i class="fab fa-facebook"></i></a></li>
								<li><a href=""><i class="fab fa-twitter"></i></a></li>
							</ul>
						</div>
					</div>
					<div class="footer-menu">
						<div class="footer-bloc"><a href="">Sitemap</a></div>
						<div class="footer-bloc"><a href="/legal_terms">Legal terms</a></div>
						<div class="footer-bloc"><a href="/terms_conditions">Terms and conditions</a></div>
						<div class="footer-bloc"><a href="">Contact</a></div>
						<div class="footer-bloc"><div>Developped by Group 1</div></div>
					</div>
				</div>
			</footer>

			<div class="cookie-menu">
				<div class="inner">
					<h2>Cookie consent</h2>
					<p>Before to use our website, you must know our website use cookies to improve your browsing experience on
						our website. No personalized content and targeted ad are used, that is why we need your consent 
					to access to the website because only necessary cookies are used.</p>
					<div class="button black">
						<div class="link" id="cookie-accept" style="color: black">I accept these conditions</div>
					</div>
				</div>
			</div>

			<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
			<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
			@yield('script')
			<script>
				val=0;
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				$(".fa-bars").click(function(){
					if(!$("header").hasClass("menu-open")){
						$("header").addClass("menu-open");
						$(".fa-bars").addClass("fa-times");
						$(".fa-times").removeClass("fa-bars");
					} else {
						$("header").removeClass("menu-open");
						$(".fa-times").addClass("fa-bars");
						$(".fa-bars").removeClass("fa-times");
					}
				});
				$(window).scroll(function (params) {
					if ($(window).scrollTop() !== 0) {
						if($(window).scrollTop() > val){
							$('body').removeClass("scroll-up");
							$('body').addClass("scroll-down");
							$('.fixed').addClass("col-lg-3");
						} else {
							$('body').removeClass("scroll-down");
							$('body').addClass("scroll-up");
						}
					} else {
						$('.fixed').removeClass("col-lg-3");
						$('body').removeClass("scroll-up");
					}
					val=$(window).scrollTop();
				})
			</script>
			<script>
				$('#notif').focusout(function(){
					$.ajax({
						type: "PUT",                
						url: "/notif"
					}).then(function(){
						$('#notif').html('<i class="fas fa-bell"></i>');
						$('#notif_dropdown').html('You don\'t have notifications');
					}).catch(function(){
						
					});
				});
			</script>
			<script>

				$('#cookie-accept').click(function () {
					var d = new Date();
					d.setTime(d.getTime() + (30*24*60*60*1000));
					var expires = "expires="+ d.toUTCString();
					document.cookie = "check-cookie-bde=ok;"+ expires + ";path=/";
					$('.cookie-menu').attr('style', 'display: none');
				});

				function getCookie(cname) {
					var name = cname + "=";
					var decodedCookie = decodeURIComponent(document.cookie);
					var ca = decodedCookie.split(';');
					for(var i = 0; i <ca.length; i++) {
						var c = ca[i];
						while (c.charAt(0) == ' ') {
							c = c.substring(1);
						}
						if (c.indexOf(name) == 0) {
							return c.substring(name.length, c.length);
						}
					}
					return "";
				}

				function checkCookie(){
					var check = getCookie("check-cookie-bde");
					console.log(check);
					if (check !== "ok") {
						$('.cookie-menu').css('display', 'flex');
					}
				}

				$(document).ready(checkCookie());

			</script>
		</body>
		</html>
