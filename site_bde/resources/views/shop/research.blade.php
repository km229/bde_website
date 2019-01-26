@extends('template')

@section('title')
{{$search}} | Research a product
@endsection

@section('body')
<div class="row">

	<div class="col-lg-3">

		<h1>Research a product</h1>
		<div class="list-group card my-4 card-search">
			<a href="/shop" class="list-group-item black">Return to shop</a>
		</div>
		<div class="card my-4">
			<h5 class="card-header card-search black">Search</h5>
			<div class="card-body">
				<div class="input-group">
				<form action="/shop/search" method="GET" class="form-search">
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

		<div class="list-group card my-4 card-search">
			<h4 class="card-header black">Filters</h4>
			<form action="/shop/search/filter" method="GET">
			<input type="hidden" name="request" value="{{$search}}" />
			<div class="list-group-item buttoncat black"><input type="radio" name="category" id="category" value="" <?php if(!isset($_GET['category']) || $_GET['category']===""){ echo 'checked'; } ?>> All</div>
			<?php
			$category = DB::table('category')->get();
			?>
			@foreach ($category as $cat)
			<div class="list-group-item buttoncat black"><input type="radio" name="category" id="category" value="<?php echo $cat -> category_name ?>" <?php if(isset($_GET['category']) && $_GET['category']===$cat -> category_name){ echo 'checked'; } ?>> <?php echo $cat -> category_name ?></div>
			@endforeach
			<div class="list-group-item black">
				Min
				<input type="number" name="min" id="min" style="width: 100%" value="<?php if(isset($_GET['min']) && $_GET['min']!==""){ echo $_GET['min']; } ?>" />
			</div>
			<div class="list-group-item black">
				Max
				<input type="number" name="max" id="max" style="width: 100%" value="<?php if(isset($_GET['max']) && $_GET['max']!==""){ echo $_GET['max']; } ?>" />
			</div>
			<div class="list-group-item button black" id="submit">
				<input type="submit" style="width: 100%" />
			</div>
			</form>
		</div>

		<?php
		if(sizeof($_SESSION) > 0){
			$table = DB::table('members')->where('member_id', $_SESSION['id'])->get();
			if($table[0]->is_admin == 1){
				echo '<div class="list-group card my-4 card-search">
				<h4 class="card-header black">Administration</h4>
				<a href="/shop/add/product" class="list-group-item black">New product</a>
				<a href="/shop/add/category" class="list-group-item black">New category</a>
				</div>';
			}
		}
		?>



	</div>
	<!-- /.col-lg-3 -->

	<div class="col-lg-9">
		
		<?php
		if(!empty($verif_product[0])){
			echo '<h2>Your research for : '.$search.'</h2>';
		} else {
			echo '<h2>No activity found with : '.$search.'</h2><p>Try with other words</p>';
		}
		?>

		<div class="row">

		<?php
			foreach ($products as $product){

				echo '<div class="col-lg-4 col-md-6 mb-4 product"><div class="card h-100 bloc-link"><a href="/shop/'.$product -> product_id.'"></a>'; 
				if(isset($product -> product_img)){
					echo '<img class="card-img-top" src="data:image/png;base64,'.base64_encode($product -> product_img) .'" />'; 
				} else { 
					echo '<img class="card-img-top" src="'.asset('img/noimg.jpg').'" />';
				}
				echo '<div class="card-body card-body2"><h2 class="card-title">'.$product -> product_name.'</h2>'.
				'<p>'.$product -> product_desc.'</p><h5>'.$product -> category_name.'</h5></div>'.
				'<div class="card-footer card-body2"><div></div> <h4 class="number">'.$product -> product_price.' €</h4><div class="button"><a class="btn btn-secondary" type="button" href="shop/add_'.$product -> product_id.'"><span class="black">Add to cart</span></a></div>'.
				'</div></div></div>';
			}
			?>

		</div>
		{{ $links }}
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
			urlValue = "/shop/search";
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
					text = data[i].product_desc.substr(0,25);
					if(data[i].product_desc.length>25){
						text+="...";
					}
					$(".dropdown-item:eq("+i+")").css('display', 'block');
					$(".dropdown-item:eq("+i+")").html(
						'<h3>'+data[i].product_name+'</h3>'+
						'<div>'+text+'<p class="date">'+data[i].product_price+' €</span></p>'+
						'<a href="/shop/'+data[i].product_id+'" class="number">See the product >></a>'
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
						'<div class="dropdown-item"><h3>No product</h3>'+
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

