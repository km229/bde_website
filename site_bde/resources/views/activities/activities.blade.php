@extends('template')

@section('title')
Activities
@endsection

@section('body')
<div class="row">
	<div class="col-lg-3">

		<h1 class="my-4">BDE CESI Saint-Nazaire</h1>
		<div class="card my-4">
			<h5 class="card-header black">Search</h5>
			<div class="card-body">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Search for...">
					<span class="input-group-btn">
						<button class="btn btn-secondary" type="button">Go!</button>
					</span>
				</div>
			</div>
			
		</div>
		
		<div class="list-group card my-4 card-search">
			<h5 class="card-header black">Administration</h5>
			<a href="/shop/add/product" class="list-group-item black">New activity</a>

		</div>

	</div>
	<!-- /.col-lg-3 -->

	<div class="col-lg-9">

		<div class="row">
			@foreach ($activities as $activity)
			<div class="col-lg-4 col-md-6 mb-4">
				<div class="card h-100 ">
					<a href="#"><?php echo '<img src="data:image/png;base64,'.base64_encode($activity -> activity_img) .'" />'; ?></a>
					<div class="card-body card-body2">
						<h4 class="card-title">
							<a href="#"><?php  echo $activity -> activity_title ?></a>
						</h4>
						<p>Date : <?php  echo $activity -> activity_date ?></p>
						<p><?php  echo $activity -> activity_desc ?></p>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</div>
@endsection

