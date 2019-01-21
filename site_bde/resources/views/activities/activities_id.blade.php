@extends('template')

@section('title')
Activities
@endsection

@section('body')
<div class="container">
	<div class="row">
		<div class="col-lg-3">

			<h2 class="my-4">BDE CESI Saint-Nazaire</h2>

			<div class="list-group card my-4 card-search">
				<h5 class="card-header black">Administration</h5>
				<a href="{{$id}}/update" class="list-group-item black">New activity</a>

			</div>

		</div>
		<div class="col-lg-9">

			<?php

			$r = $_SERVER['REQUEST_URI']; 
			$id = explode('/', $r)[2];

			$table = DB::table('activity')->get()->where('activity_id',$id);

			$index = $table->keys()[0];

			$activity = $table[$index];
  //dd($activity);
			?>

			<!-- Portfolio Item Heading -->
			<h1 class="my-4">{{$activity->activity_title}}</h1>

			<!-- Portfolio Item Row -->
			<div class="row">

				<div class="col-md-8">
					<?php echo '<img class="w-100" src="data:image/png;base64,'.base64_encode($activity -> activity_img) .'" />'; ?>
				</div>

				<div class="col-md-4">
					<h3 class="my-3">Description</h3>
					<p>{{$activity->activity_desc}}</p>
					<h3 class="my-3">Date</h3>
					<p>{{$activity->activity_date}}</p>
				</div>

			</div>
			<!-- /.row -->

			<!-- Related Projects Row -->
			
			<!-- /.row -->
		</div>
		<h3 class="my-4">Related Projects</h3>

			<div class="row">

				<div class="col-md-3 col-sm-6 mb-4">
					<a href="#">
						<img class="img-fluid" src="http://placehold.it/500x300" alt="">
					</a>
				</div>

				<div class="col-md-3 col-sm-6 mb-4">
					<a href="#">
						<img class="img-fluid" src="http://placehold.it/500x300" alt="">
					</a>
				</div>

				<div class="col-md-3 col-sm-6 mb-4">
					<a href="#">
						<img class="img-fluid" src="http://placehold.it/500x300" alt="">
					</a>
				</div>

				<div class="col-md-3 col-sm-6 mb-4">
					<a href="#">
						<img class="img-fluid" src="http://placehold.it/500x300" alt="">
					</a>
				</div>

			</div>
	</div>
</div>
@endsection