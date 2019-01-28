@extends('template')

@section('title')
{{ $activity[0]->activity_title }} | Activities
@endsection

@section('body')
<div class="container">
	<div class="row">
		<div class="col-lg-3">
			<h2 class="my-4">Activity</h2>

			<?php
			if(sizeof($_SESSION) > 0){
				echo '<div class="list-group card my-4 card-search">';
				echo'<h3 class="card-header black">Activity</h3>';
				if($activity[0]->activity_date < date('Y-m-d')){
					if(sizeof($verif)>0){
						echo '<a href="/activities/'.$id.'/add_picture" class="list-group-item black">Add picture</a>';
					}
				}else{
					if(sizeof($verif)==0){
						echo'<a href="/activities/'.$id.'/join" class="list-group-item black">Join</a>';
					}else{
						echo'<a href="/activities/'.$id.'/leave" class="list-group-item black">Leave</a>';
					}
				}
				echo '</div>';
			}
			?>
			<?php
			if(sizeof($_SESSION) > 0){
				if($table[0]->is_admin == 1 || $table[0]->state_name != 'Student'){
					echo '<div class="list-group card my-4 card-search">
					<h3 class="card-header black">Administration</h3>';
					if($table[0]->is_admin == 1){

						echo'<a href="/activities/'.$id.'/download_registration" class="list-group-item black">Download participants</a>
						<a href="/activities/'.$id.'/update" class="list-group-item black">Update activity</a>
						<a href="/activities/'.$id.'/delete" class="list-group-item black">Delete</a>';
					}
					if($table[0]->state_name != 'Student'){
						echo'<a href="/activities/'.$id.'/download_pictures" class="list-group-item black">Download pictures</a>
						<a href="/activities/'.$id.'/warning" class="list-group-item black">Report</a>';
					}
					echo'</div>';
				}

			}
			?>
			<div class="list-group card my-4 card-search">
				<a href="/activities" class="list-group-item black">Back</a>
			</div>
		</div>
		<div class="col-lg-9">

			<!-- Portfolio Item Heading -->
			<h1 class="my-4">{{$activity[0]->activity_title}}</h1>

			<!-- Portfolio Item Row -->
			<div class="row">

				<div class="col-md-8">
					<?php echo '<img class="w-100" src="data:image/png;base64,'.base64_encode($activity[0] -> activity_img) .'" />'; ?>
				</div>

				<div class="col-md-4">
					<h3 class="my-3">Description</h3>
					<p>{{$activity[0]->activity_desc}}</p>
					<h3 class="my-3">Date</h3>
					<p>{{$activity[0]->activity_date}}</p>
					<h3 class="my-3">Type</h3>
					<p><?php switch($activity[0]->activity_recurrence) {
						case 0:
						echo "Punctual";
						break;
						case 1:
						echo "Weekly";
						break;
						case 2:
						echo "Monthly";
						break;
						case 3:
						echo "Yearly";
						break;
					} ?></p>
					<h3 class="my-3">Price</h3>
					<p>{{$activity[0]->activity_price}} €</p>
				</div>

			</div>
			<!-- /.row -->

			<!-- Related Projects Row -->

			<!-- /.row -->
		</div>
		<h2 class="my-4">Related pictures</h2>

		<div class="col-lg-12">
			<div class="row">

				<?php

				$table_picture = DB::table('activity_pictures')->get()->where('activity_id_fk', $id);

				foreach ($table_picture as $el) {

					echo '<div class="col-md-3 col-sm-6 mb-4">
					<div class="content"><a href="/activities/'.$id.'/img_'.$el->picture_id.'"><div class="img">
					<img class="img-fluid class="w-100" src="data:image/png;base64,'.base64_encode($el -> picture_img) .'" alt="">
					</div></a></div>
					<div class="list-group-item">';
					if($table[0]->is_admin == 1){
						echo'<a href="'.$id.'/img_'.$el ->picture_id.'/delete" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>';
					}
					if($table[0]->state_name != 'Student'){
						echo'<a href="'.$id.'/img_'.$el ->picture_id.'/warning" class="btn btn-warning"><i class="fas fa-exclamation-triangle"></i></a>';
					}
					echo'</div></div>';
				}

				?>

			</div>
		</div>
	</div>
</div>
@endsection
