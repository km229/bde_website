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

<section>
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" >
	<ol class="carousel-indicators">
		<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
		<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
		<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
	</ol>
	<div class="carousel-inner">
		<div class="carousel-item active">
			<img class="d-block w-100" src="{{ asset('img/group.jpg') }}" alt="First slide">
		</div>
		<div class="carousel-item">
			<img class="d-block w-100" src="{{ asset('img/group.jpg') }}" alt="Second slide">
		</div>
		<div class="carousel-item">
			<img class="d-block w-100" src="{{ asset('img/group.jpg') }}" alt="Third slide">
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
</section>

<section>
	<h1>Welcome to the BDE CESI website !</h1>
	<article> 
		<p>Each CESI centers have a BDE (Student Office) to animate life on campus. It represents all the students of the school, whether the IE CESI, the EXIA or the Cesi Alternance. The BDE is an association of students from the same school elected by their students. </p>
		<p>This website allows students to give event ideas to BDE members, to register to participate and also to publish, like and comment pictures of past events. There is also a super nice equipment store that can support us!</p>
	</article>
	<article>
		<h2>Recent activities</h2>
		<div class="container">
  			<div class="row">
		<?php
		if(sizeof($activities)>0){
			if(sizeof($activities)>4){ $size=4; }
			else { $size=sizeof($activities); }
			for ($i=0; $i < $size; $i++) { 
				echo "<div class=\"col-sm-12 col-md-6 col-lg-3\">
				<h3>". $activities[$i] -> activity_title ."</h3>
				<p>". $activities[$i] -> activity_desc ."</p>
				<img class=\"d-block w-100\" SRC=\"data:image/jpeg;base64,". base64_encode($activities[$i] -> activity_img) ."\">
			   </div>";
			}
		} else {
			echo "No recent activities to present.";
		}
		?>
  			</div>
		</div>
	</article>
	<article>
		<h2>Best products</h2>
		<div class="container">
  			<div class="row">
   				<div class="col-sm-12 col-md-6 col-lg-3">
					<img class="d-block w-100" SRC="img/lol.jpg">
   				</div>
    			<div class="col-sm-12 col-md-6 col-lg-3">
					<img class="d-block w-100" SRC="img/lol.jpg">
   				</div>
   				<div class="col-sm-12 col-md-6 col-lg-3">
					<img class="d-block w-100" SRC="img/lol.jpg">
    			</div>
				<div class="col-sm-12 col-md-6 col-lg-3">
					<img class="d-block w-100" SRC="img/lol.jpg">
    			</div>
  			</div>
		</div>
	</article>
</section>


<?php
	if(session('message')==="hello" && $_SESSION["name"]){
		echo "
		<div class=\"alert alert-success\">
		<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
			<strong>Welcome ". $_SESSION["name"] ." !</strong>
		</div>
		";
	} if(session('message')==="welcome_back" && $_SESSION["name"]){
		echo "
		<div class=\"alert alert-success\">
		<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
			<strong>Welcome back ". $_SESSION["name"] ." !</strong>
		</div>
		";
	}
?>

@endsection
