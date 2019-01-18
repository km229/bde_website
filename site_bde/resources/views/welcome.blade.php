<?php
if(!isset($_SESSION)){
    session_start();
} 
?>

@extends('template')

@section('title')
Site
@endsection

@section('body')
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
	<ol class="carousel-indicators">
		<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
		<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
		<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
	</ol>
	<div class="carousel-inner">
		<div class="carousel-item active">
			<img class="d-block w-100" src="{{ asset('img/lol.jpg') }}" alt="First slide">
		</div>
		<div class="carousel-item">
			<img class="d-block w-100" src="{{ asset('img/lul.jpg') }}" alt="Second slide">
		</div>
		<div class="carousel-item">
			<img class="d-block w-100" src="{{ asset('img/lil.jpg') }}" alt="Third slide">
		</div>
	</div>
	<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	</a>
</div>
<section>
	<article>
		<h1>Presentation</h1>
		Welcome to the BDE website ! </br>
		Each CESI centers have a BDE (Student Office) to animate life on campus. It represents all the students of the school, whether the IE CESI, the EXIA or the Cesi Alternance. The BDE is an association of students from the same school elected by their students. </br>
		This website allows students to give event ideas to BDE members, to register to participate and also to publish, like and comment pictures of past events. There is also a super nice equipment store that can support us!
	</article>
	<article>
		<h2>Activities</h2>
		<div class="container">
  			<div class="row">
   				<div class="col-sm">
					<img class="d-block w-100" SRC="img/lol.jpg">
   				</div>
    			<div class="col-sm">
					<img class="d-block w-100" SRC="img/lol.jpg">
   				</div>
   				<div class="col-sm">
					<img class="d-block w-100" SRC="img/lol.jpg">
    			</div>
				<div class="col-sm">
					<img class="d-block w-100" SRC="img/lol.jpg">
    			</div>
  			</div>
		</div>
	</article>
	<article>
		<h2>Shop</h2>
		<div class="container">
  			<div class="row">
   				<div class="col-sm">
					<img class="d-block w-100" SRC="img/lol.jpg">
   				</div>
    			<div class="col-sm">
					<img class="d-block w-100" SRC="img/lol.jpg">
   				</div>
   				<div class="col-sm">
					<img class="d-block w-100" SRC="img/lol.jpg">
    			</div>
				<div class="col-sm">
					<img class="d-block w-100" SRC="img/lol.jpg">
    			</div>
  			</div>
		</div>
	</article>
</section>

<?php
	if(session()->has('message') && session('message')==="hello" && $_SESSION["name"]){
		echo "
		<div class=\"alert alert-success\">
		<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
			<strong>Welcome ". $_SESSION["name"] ." !</strong>
		</div>
		";
	}
?>

@endsection
