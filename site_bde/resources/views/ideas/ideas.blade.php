@extends('template')

@section('title')
Ideas
@endsection

@section('body')

<div class="row">

	<div class="col-lg-3">

		<h1 class="my-4">Idea box</h1>
		<p  class="my-4">Idea box allows students of the school to give event ideas to BDE members.</p>
		<p  class="my-4">Don't hesitate to add ideas !</p>
		<div class="card my-4">
			<h3 class="card-header black">Search</h3>
			<div class="card-body">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Search for...">
				</div>
				<div class="form-group black">
					<label for="sel1">Number of ideas per page:</label>
					<select class="form-control" id="ideas_page">
						<option value="9">9</option>
						<option value="18">18</option>
						<option value="36">36</option>
						<option value="72">72</option>
					</select>
				</div>
			</div>
		</div>
		<?php
		if(sizeof($_SESSION) > 0){
			echo'<div class="list-group card my-4 card-search">
			<a href="/ideas/create" class="list-group-item black">New idea</a>
			</div>';
		}
		?>
		
	</div>
	<!-- /.col-lg-3 -->

	<div class="col-lg-9">
		<div class="content">
			<div class="row">
				<?php
				if(sizeof($ideas)>0){
					for ($i=0; $i < sizeof($ideas); $i++) { 
						echo '<div class="col-lg-4 col-md-6 mb-4">
						<div class="card h-100 bloc-link">
						<div class="card-body card-body2">
						<h2 class="card-title">'. $ideas[$i] -> idea_title .'</h2>
						<p>'. $ideas[$i] -> idea_desc .'</p>
						<div class="date">';
						$val_like='0';
						for($y=0; $y < sizeof($likes); $y++){
							if($ideas[$i]->idea_id==$likes[$y]->idea_id){
								$val_like = $likes[$y]->idea_likes;
							}
						} 
						echo $val_like.' <i class="fas fa-heart"></i></div>
						<div class="date">Créée par '. $ideas[$i] -> member_firstname .' '. $ideas[$i] -> member_lastname .'</div>
						</div>
						<a href="ideas/'.$ideas[$i]->idea_id.'"></a>
						</div></div>';
					}
				} else {
					echo "<p>All ideas have been processed, feel free to add a new one <a href=\"ideas/create\">here</a>!";
				}
				?>
			</div>
			{!! $links !!}
		</div>
	</div>
	@endsection