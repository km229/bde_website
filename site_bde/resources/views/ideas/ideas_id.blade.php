@extends('template')

@section('title')
{{ $idea[0] -> idea_title }}
@endsection

@section('body')

<div class="container">
	<div class="row">
		<div class="col-lg-3">

			<h2>Idea box</h2>

			
			<?php

			if(sizeof($_SESSION) > 0){
				$table = DB::table('members')->where('member_id', $_SESSION['id'])->get();

				if(($_SESSION['id']===$idea[0]->member_id_fk) || ($table[0]->is_admin == 1)){
					echo '<div class="list-group card my-4 card-search">
					<h3 class="card-header black">Manage idea</h3>
					<a href="/ideas/'.$idea[0]->idea_id.'/update" class="list-group-item black">Update idea</a>
					<a href="/ideas/'.$idea[0]->idea_id.'/delete" class="list-group-item black">Delete idea</a>
					</div>';
				}
				if($table[0]->is_admin == 1){
					echo '<div class="list-group card my-4 card-search">
					<h3 class="card-header black">Administration</h3>
					<a href="/activities/create?id='.$idea[0]->idea_id.'" class="list-group-item black">Create this activity</a>
					</div>';
				}
			}
			?>
			<div class="list-group card my-4 card-search black">
				<a href="/ideas" class="list-group-item black">Back</a>
			</div>

		</div>
		<div class="col-lg-9">
			<!-- Portfolio Item Heading -->
			<h1>{{ $idea[0]->idea_title }}</h1>

			<div>
				<h3 class="my-3">Description</h3>
				<p>{{ $idea[0]->idea_desc }}</p>
				<h3 class="my-3">Likes</h3>
				<span class="nb_like">
					<?php if(isset($like[0]->idea_likes)){ echo $like[0]->idea_likes; } 
					else { echo '0'; }
					echo ' ';?>
				</span>
				<?php
				if(sizeof($verif_like)==0){
					echo ' <span class="like"><span class="Like"><i class="fas fa-thumbs-up"></i></span></span>';
				} else {
					echo ' <span class="like"><span class="Dislike"><i class="fas fa-thumbs-down"></i></i></span></span>';
				}
				?>
			</div>
		</div>
	</div>

</div>
</div>

@endsection

@section('script')
<script>
	$(".like").click(function name(params) {
		urlValue = <?php echo "'/ideas/".$idea[0]->idea_id."'"; ?>;
		$.ajax({
			method: 'POST',
			url: urlValue,
			data: { affect: $(".like span").attr("class") }
		}).then(function name(data) {
			if(data==="ok"){
				oldval=parseInt($(".nb_like").text());
				switch ($(".like span").attr("class")) {
					case "Like":
					oldval++;
					$(".nb_like").text(oldval+++' ');
					$(".like span").attr("class", "Dislike");
					$(".like span i").attr("class", "fas fa-thumbs-down");
					break;
					case "Dislike":
					oldval--;
					$(".nb_like").text(oldval--+' ');
					$(".like span").attr("class", "Like");
					$(".like span i").attr("class", "fas fa-thumbs-up");
					break;
					default:
					break;
				}
			} if(data==="ko"){
				alert('Error like/dislike');
			}
		});
	});
</script>
@endsection
