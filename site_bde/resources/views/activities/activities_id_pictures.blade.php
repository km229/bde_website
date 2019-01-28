@extends('template')

@section('title')
<?php
$activity = DB::table('activity_pictures')->join('activity', 'activity_id', '=', 'activity_id_fk')->where('picture_id', '=', $id2)->get();
?>
Picture n°{{$id2}} | {{$activity[0]->activity_title}}
@endsection

@section('body')
<section>
	<div class="row">
		<div class="col-lg-3 mb-5">
			<h2>Pictures & commentaries</h2>
			<div class="list-group card my-4 card-search">
				<a href="/activities/<?php echo $id; ?>" class="list-group-item black">Back to activity</a>
				<a href="/activities" class="list-group-item black">Return to activities</a>
			</div>
			<h3 class="my-4">Likes</h3>
			<span class="nb_like">
				<?php if(!empty($like)){ echo sizeof($like); } 
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
		<div class="col-lg-9">
			<?php 
			$table = DB::table('activity_pictures')->where('picture_id', $id2)->get();
			echo '<img class="w-100" src="data:image/png;base64,'.base64_encode($table[0] -> picture_img) .'" />'; 
			?>
		</div>
	</div>
</section>
<section>
	<div class="col-sm-12">
		<div class="card">
			<div class="card-body card-body2">
				<h2>Add a commentary</h2>
				<div class="container">
					{!! form($form) !!}
				</div>
			</div>
		</div>
	</div>
</section>
<?php
$table = DB::table('comment_picture_member')->join('members', 'member_id_fk','=','member_id')->where('picture_id_fk', $id2)->get();
$verif = DB::table('members')->where('member_id', $_SESSION['id'])->get();
echo '<section>';
foreach ($table as $el) {
	echo '
	<div class="col-sm-12">
	<div id="comment_'.$el->comment_id.'" class="card">
	<div class="card-body card-body2">
	<h2>'.$el->member_firstname.' '.$el->member_lastname.'</h2>
	<h3>'.$el->comment.'</h3>
	<p class="date"> Published : '.$el->comment_date.'</p>';
	if($el->member_id_fk===$_SESSION['id'] || $verif[0]->is_admin===1){
		echo '<a href="/activities/'.$id.'/img_'.$id2.'/comment_'.$el->comment_id.'/delete" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>';
		echo '<a href="/activities/'.$id.'/img_'.$id2.'/comment_'.$el->comment_id.'/warning" class="btn btn-warning"><i class="fas fa-exclamation-triangle"></i></a>';
	}
	echo '</div></div></div>';
}
echo '</section>';
?>
@endsection

@section('script')
<script>
	$(".like").click(function name(params) {
		urlValue = <?php echo "'/activities/".$id."/img_".$id2."/like'"; ?>;
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