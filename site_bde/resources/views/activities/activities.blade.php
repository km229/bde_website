@extends('template')

@section('title')
Activities
@endsection

@section('body')
<div class="row">
	<div class="col-lg-3">

		<h1 class="my-4">Activities</h1>
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
		
		<?php
		if(sizeof($_SESSION) > 0){
			$table = DB::table('members')->get()->where('member_id', $_SESSION['id']);
			$index = $table->keys()[0];

			if($table[$index]->is_admin == 1){
				echo '<div class="list-group card my-4 card-search">
				<h5 class="card-header black">Administration</h5>
				<a href="/activities/create" class="list-group-item black">New activity</a>

				</div>';
			}
		}
		
		?>
		

	</div>
	<!-- /.col-lg-3 -->

	<div class="col-lg-9">

		<div class="row">
			<?php
			foreach($activities as $activity){
				echo '<div class="col-lg-4 col-md-6 mb-4 bloc-link">
				<div class="card h-100">';
						if(isset($activity -> activity_img)){
							echo '<img class="w-100" src="data:image/png;base64,'.base64_encode($activity -> activity_img) .'" />';
						} else { echo '<img class="w-100" src="'.asset('img/noimg.jpg').'" />'; }
					echo '<div class="card-body card-body2">
						<h2 class="card-title">'.$activity -> activity_title.'</h2>
						<p>Date : '.$activity -> activity_date.'</p>
						<p>'.$activity -> activity_desc.'</p>
						<p>Price : '.$activity -> activity_price.' €</p>
						<p>Type : '.$activity -> activity_recurrence.'</p>
					</div>
					<a href="/activities/'.$activity -> activity_id.'"></a>
				</div>
			</div>';
			}?>

		</div>
	</div>
</div>
@endsection

