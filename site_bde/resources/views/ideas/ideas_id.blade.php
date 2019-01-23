@extends('template')

@section('title')
{{ $idea[0] -> idea_title }}
@endsection

@section('body')

<div class="container">
	<div class="row">
		<div class="col-lg-3">

			<h2 class="my-4">Idea box</h2>

			
				<?php
                
		if(sizeof($_SESSION) > 0){
			$table = DB::table('members')->get()->where('member_id', $_SESSION['id']);
            $index = $table->keys()[0];
            
            if(($_SESSION['id']===$idea[0]->member_id_fk) || ($table[$index]->is_admin == 1)){
				echo '<div class="list-group card my-4 card-search">
				<h3 class="card-header black">Manage idea</h3>
				<a href="/ideas/'.$idea[0]->idea_id.'/update" class="list-group-item black">Update idea</a>
                <a href="/ideas/'.$idea[0]->idea_id.'/delete" class="list-group-item black">Delete idea</a>
				</div>';
            }
			if($table[$index]->is_admin == 1){
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
			<h1 class="my-4">{{ $idea[0]->idea_title }}</h1>

			<div class="col-md-4">
				<h3 class="my-3">Description</h3>
				<p>{{ $idea[0]->idea_desc }}</p>
				<h3 class="my-3">Likes</h3>
				<span class="nb_like">
					<?php if(isset($like[0]->idea_likes)){ echo $like[0]->idea_likes; } 
					else { echo '0'; }?>
				</span>
				<i class="fas fa-heart"></i>
				<div class="button">
					<?php
					if(empty($verif_like[0])){
						echo '<a class="like">Like</a>';
					} else {
						echo '<a class="like">Dislike</a>';
					}
					?>
					
				</div>
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
			data: { affect: $(".like").html() }
		}).then(function name(data) {
			if(data==="ok"){
				oldval=parseInt($(".nb_like").text());
				switch ($(".like").text()) {
					case "Like":
					oldval++;
					$(".nb_like").text(oldval++);
					$(".like").text("Dislike");
					break;
					case "Dislike":
					oldval--;
					$(".nb_like").text(oldval--);
					$(".like").text("Like");
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