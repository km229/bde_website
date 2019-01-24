@extends('template')

@section('title')
Activities
@endsection

@section('body')
<div class="row">
	<div class="col-lg-3">

		<h1 class="my-4">Activities</h1>
		<div class="card my-4">
			<h3 class="card-header black">Search</h3>
			<div class="card-body">
				<div class="input-group">
                    <form action="/activities/search" method="GET" class="form-search">
					<div class="input-group">
					<input type="text" class="form-control" id="search" name="request" placeholder="Search for...">
					<span class="input-group-btn">
						<input class="btn btn-secondary" type="submit" value="Go!">
					</span>
					</div>
					</form>
				<div class="dropdown-menu search">
				</div>
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
        <?php 
        if(!empty($verif_activity[0])){
            echo '<h2>Your research for : '.$search.'</h2>';
        } else {
			echo '<h2>No activity found with : '.$search.'</h2><p>Try with other words</p>';
        }
        ?>
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
		{{ $links }}
	</div>
</div>
@endsection

@section('script')
<script>
	$("#search").focus(function () {
		if($("#search").val()!==''){
			$(".search").css('display', 'block');
		}
	});
	/*$("#search").focusout(function () {
		$(".search").css('display', 'none');
	});*/
	val=0;
	content='';
	$("#search").keyup(function () {
		if(content!==$("#search").val() && $("#search").val()!==''){
			urlValue = "/search/activities";
			$.ajax({
			method: 'POST',
			url: urlValue,
			data: { search: $("#search").val() }
			}).then(function (data) {
				$(".search").css('display', 'block');
				if(data.length>5){
					size=5;
				} else { size=data.length }
				$(".search").html('');
				for(i=0; i<size; i++){
					concat=$(".search").html();
					$(".search").html(concat+
						'<div class="dropdown-item">'+
						'<h3>'+data[i].activity_title+'</h3>'+
						'<div>'+data[i].activity_desc+'</div>'+
						'<a href="/activities/'+data[i].activity_id+'" class="number">See the activity >></a>'+
						'</div><div class="dropdown-divider"></div>'
					);
				}
				if(data.length===0){
					$(".search").html(
					'<div class="dropdown-item"><h3>No content</h3>'+
						'<div>Try with other key words</div>'
					);
				}
				result=$(".search").html();
				if(data.length>5){
					number = data.length - 5;
					$(".search").html(result+'<strong class="dropdown-item number">+'+number+'</strong>');
				}
			}).catch(function (data) {
				$(".search").css('display', 'block');
				$(".search").html(
					'<div class="dropdown-item"><h3>Error</h3>'+
						'<div>Try again</div>'
				);
			});
		} if($("#search").val()==='') { $(".search").css('display', 'none'); }
		content=$("#search").val();
	});
</script>
@endsection