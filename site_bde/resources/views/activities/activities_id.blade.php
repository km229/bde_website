@extends('template')

@section('title')
<?php echo $activity[0]->activity_title.' | Activities';?>
@endsection

@section('body')
<div class="container">
	<div class="row">
		<div class="col-lg-3">

			<h2 class="my-4">Activity</h2>
			<div class="list-group card my-4 card-search">
					<h3 class="card-header black">Activity</h3>
				<?php
					if(sizeof($verif)==0){
					echo'<a href="/activities/'.$id.'/join" class="list-group-item black">Join</a>';
				}else{
					echo'<a href="/activities/'.$id.'/leave" class="list-group-item black">Leave</a>';

				}
				echo '<a href="/activities/'.$id.'/add_picture" class="list-group-item black">Add picture</a>';
				?>
				</div>
			<?php
			if(sizeof($_SESSION) > 0){
				if($table[0]->is_admin == 1){
					echo '<div class="list-group card my-4 card-search">
					<h3 class="card-header black">Administration</h3>
					<a href="/activities/create?id='.$id.'" class="list-group-item black">Registrations</a>
					<a href="/activities/'.$id.'/update" class="list-group-item black">Update activity</a>
					<a href="/activities/'.$id.'/delete" class="list-group-item black">Delete</a>
					</div>';
				}

			}
			?>
			<div class="list-group card my-4 card-search">
				<a href="/activities" class="list-group-item black">Back</a>
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
					<h3 class="my-3">Type</h3>
					<p>{{$activity->activity_recurrence}}</p>
					<h3 class="my-3">Price</h3>
					<p>{{$activity->activity_price}} €</p>
				</div>

			</div>
			<!-- /.row -->

			<!-- Related Projects Row -->

			<!-- /.row -->
		</div>
		<h3 class="my-4">Related Projects</h3>

		<div class="col-lg-12">
			<div class="row">

				<?php

				$table = DB::table('activity_pictures')->get()->where('activity_id_fk', $id);

				foreach ($table as $el) {
					echo '<div class="col-md-3 col-sm-6 mb-4">
					<a href="/activities/'.$id.'/img_'.$el->picture_id.'">
					<img class="img-fluid w-100" src="data:image/png;base64,'.base64_encode($el -> picture_img) .'" alt="">
					</a>
					<div class="list-group-item">
					<a href="'.$id.'/img_'.$el ->picture_id.'/delete" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
					</div></div>';
				}

				?>

			</div>
		</div>
	</div>
</div>
@endsection