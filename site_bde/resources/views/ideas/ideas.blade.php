@extends('template')

@section('title')
Ideas
@endsection

@section('body')

<div class="row">

	<div class="col-lg-3">
		<h1>Idea box</h1>
		<p  class="my-4">Idea box allows students of the school to give event ideas to BDE members.</p>
		<div class="card my-4">
			<h3 class="card-header black">Search</h3>
			<div class="card-body">
			<div class="input-group">
					<form action="/ideas/search" method="GET" class="form-search">
						<div class="input-group">
							<input type="text" class="form-control" id="search" name="request" placeholder="Search for...">
							<span class="input-group-btn">
								<input class="btn btn-secondary" type="submit" value="Go!">
							</span>
						</div>
					</form>
					<div class="dropdown-menu search">
						<div class="dropdown-item"></div>
						<div class="dropdown-item"></div>
						<div class="dropdown-item"></div>
						<div class="dropdown-item"></div>
						<div class="dropdown-item"></div>
						<div class="dropdown-item"></div>
					</div>
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
						echo $val_like.' <i class="fas fa-thumbs-up"></i></div>
						<div class="date">Created by '. $ideas[$i] -> member_firstname .' '. $ideas[$i] -> member_lastname .'</div>
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
	@endsection

	@section('script')
<script>
	//affiche les activites
	$("#search").focus(function () {
		if($("#search").val()!==''){
			$(".search").css('display', 'block');
		}
	});
	$(".dropdown-item:eq(0)").click(function () {
		$("#search").val(($(".dropdown-item:eq(0) h3").text()));
		$(".search").css('display', 'none');
	});
	$(".dropdown-item:eq(1)").click(function () {
		$("#search").val(($(".dropdown-item:eq(1) h3").text()));
		$(".search").css('display', 'none');
	});
	$(".dropdown-item:eq(2)").click(function () {
		$("#search").val(($(".dropdown-item:eq(2) h3").text()));
		$(".search").css('display', 'none');
	});
	$(".dropdown-item:eq(3)").click(function () {
		$("#search").val(($(".dropdown-item:eq(3) h3").text()));
		$(".search").css('display', 'none');
	});
	$(".dropdown-item:eq(4)").click(function () {
		$("#search").val(($(".dropdown-item:eq(4) h3").text()));
		$(".search").css('display', 'none');
	});
	/*$("#search").focusout(function () {
		$(".search").css('display', 'none');
	});*/
	//content=last value
	content='';
	$("#search").keyup(function () {
		//si on entre une valeur différente
		if(content!==$("#search").val() && $("#search").val()!==''){
			//ajax
			urlValue = "/ideas/search";
			$.ajax({
				method: 'POST',
				url: urlValue,
				data: { search: $("#search").val() }
			}).then(function (data) {
				//success - affiche les activites
				$(".search").css('display', 'block');
				//taille max d'affichage
				if(data.length>5){
					size=5;
				} else { size=data.length }
				//insertion activites
				for(i=0; i<size; i++){
					text = data[i].idea_desc.substr(0,15);
					if(data[i].idea_desc.length>15){
						text+="...";
					}
					$(".dropdown-item:eq("+i+")").css('display', 'block');
					$(".dropdown-item:eq("+i+")").html(
						'<h3>'+data[i].idea_title+'</h3>'+
						'<div>'+text+'</div>'+
						'<a href="/activities/'+data[i].idea_id+'" class="number">See the idea >></a>'
						);
				}
				//si activites < 5 on cache les autres div
				for(size; size<5; size++){
					$(".dropdown-item:eq("+size+")").css('display', 'none');
				}
				//si aucune activite
				if(data.length===0){
					$(".dropdown-item:eq(5)").css('display', 'block');
					$(".dropdown-item:eq(5)").html(
						'<div class="dropdown-item"><h3>No activity</h3>'+
						'<div>Try with other key words</div>'
						);
				} else if(data.length>5){
					number = data.length - 5;
					$(".dropdown-item:eq(5)").css('display', 'block');
					$(".dropdown-item:eq(5)").html('<strong class="number">+'+number+'</strong>');
				} else {
					$(".dropdown-item:eq(5)").css('display', 'none');
				}
			}).catch(function (data) {
				//error
				for(i=0; i<5; i++){
					$(".dropdown-item:eq("+i+")").css('display', 'none');
				}
				$(".search").css('display', 'block');
				$(".dropdown-item:eq(5)").css('display', 'block');
				$(".dropdown-item:eq(5)").html(
					'<h3>Error</h3>'+
					'<p>Try again</p>'
					);
			});
		} 
		if($("#search").val()==='') { 
			$(".search").css('display', 'none');
		}
		content=$("#search").val();
	});
</script>
@endsection
