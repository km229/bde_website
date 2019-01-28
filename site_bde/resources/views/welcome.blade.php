<?php
if(!isset($_SESSION)){
	session_start();
} 
?>

@extends('template')

@section('title')
Homepage
@endsection

@section('body')

<section>
	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" >
		<ol class="carousel-indicators">
			<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
		</ol>
		<div class="carousel-inner" role="listbox" style="height: auto !important">
			<div class="carousel-item active">
                <div class="content"><div class="img"><img src="{{ asset('img/group.jpg') }}" alt="First slide"></div></div>
			<div class="carousel-caption d-none d-md-block">
			<h5>BDE CESI</h5>
			<p>Welcome !</p>
			</div>
			</div>
			<div class="carousel-item">
				<div class="content"><div class="img"><a href="activities/<?php if(!empty($activities)){ echo $activities[0] -> activity_id; } ?>"><img src="data:image/jpeg;base64,<?php if(!empty($activities)){ echo base64_encode($activities[0] -> activity_img); } ?>" alt="Next activity"></a></div></div>
				<div class="carousel-caption d-none d-md-block">
				<h5>NEXT ACTIVITY</h5>
    			<p><?php if(!empty($activities)){ echo $activities[0] -> activity_title; } ?></p>
				</div>
			</div>
			<div class="carousel-item">
				<div class="content"><div class="img"><a href="shop/<?php if(!empty($products)){ echo $products[0] -> product_id; } ?>"><img src="data:image/jpeg;base64,<?php if(!empty($activities)){ echo base64_encode($products[0] -> product_img); } ?>" alt="Next activity"></a></div></div>
				<div class="carousel-caption d-none d-md-block">
				<h5>BEST SELLER</h5>
    			<p><?php if(!empty($products)){ echo $products[0] -> product_name; } ?></p>
				</div>
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
				$size = sizeof($activities);
				if($size>0){
					for ($i=0; $i < $size; $i++) { 
						echo '<div class="col-sm-12 col-md-6 col-lg-3">
						<div><h3>'. $activities[$i] -> activity_title .'</h3>
						<div class="card h-100 bloc-link">
						<div class="content"><div class="img"><img alt="'.$activities[$i] -> activity_title.'" src="';
						if(isset($activities[$i] -> activity_img)){
							echo 'data:image/jpeg;base64,'. base64_encode($activities[$i] -> activity_img) .'" >';
						} else { echo asset('img/noimg.jpg').'" >'; }
						echo '</div></div><a href="activities/' . $activities[$i] -> activity_id . '" ></a></div></div></div>';
					}
				} else {
					echo "<p>No recent activities to present.</p>";
				}
				
				?>
			</div>
		</div>
	</article>
	<article>
		<h2>Best products</h2>
		<div class="container">
			<div class="row">
				<?php
				$size = sizeof($products);
				if($size>0){
					for ($i=0; $i < $size; $i++) { 
						echo '<div class="col-sm-12 col-md-6 col-lg-3">
						<h3>'. $products[$i] -> product_name .'</h3>
						<div class="card bloc-link">
						<div class="content"><div class="img"><img src="';
						if(isset($products[$i] -> product_img)){
							echo 'data:image/jpeg;base64,'. base64_encode($products[$i] -> product_img) .'" >';
						} else { echo asset('img/noimg.jpg').'" >'; }
						echo '</div></div><a href="shop/' . $products[$i] -> product_id . '" ></a></div><span class="number right">'.$products[$i] -> product_price.' €</span></div>';
					}
				} else {
					echo "<p>No recent activities to present.</p>";
				}
				?>
			</div>
		</div>
	</article>
</section>

@endsection
