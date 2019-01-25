@extends('template')

@section('title')
Shop
@endsection

@section('body')
<div class="row">

	<div class="col-lg-3">

		<h1 class="my-4">Shop</h1>
		<div class="card my-4">
			<h5 class="card-header card-search black">Search</h5>
			<div class="card-body">
				<div class="input-group">
				<form action="/shop/search_acticles" method="GET" class="form-search">
					@csrf
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
			<h5 class="card-header black">Categories</h5>
			<a href="/shop"  class="list-group-item buttoncat">All</a>
			@foreach ($category as $cat)
			<a href="?category=<?php echo $cat -> category_id ?>" class="list-group-item buttoncat"><?php echo $cat -> category_name ?></a>
			@endforeach


		</div>

		<div class="list-group card my-4 card-search black">
			<h5 class="card-header black">Price</h5>
			<form action="{{route('shop_price')}}" method="post">
				@csrf
				<div class="list-group-item">
					Min
					<input type="number" name="min" style="width: 100%">
				</div>
				<div class="list-group-item">
					Max
					<input type="number" name="max" style="width: 100%">
				</div>
				<div class="list-group-item button">
					<input type="submit" name="submit">
				</div>
			</form>
		</div>

		<?php
		if(sizeof($_SESSION) > 0){
			$table = DB::table('members')->where('member_id', $_SESSION['id'])->get();
			if($table[0]->is_admin == 1){
				echo '<div class="list-group card my-4 card-search">
				<h5 class="card-header black">Administration</h5>
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

		$bestsellers = DB::table('product')->orderBy('product.product_sales_number', 'DESC')->limit(3)->get();
		$size = sizeof($bestsellers);

		if ($size > 0) {
			echo "<div id=\"carouselExampleIndicators\" class=\"carousel slide my-4\" data-ride=\"carousel\">
			<ol class=\"carousel-indicators\">";


			for ($i = 0; $i < $size; $i++) {
				if ($i == 0) {
					echo "<li data-target=\"#carouselExampleIndicators\" data-slide-to=\".$i.\" class=\"active\"></li>";
				} else {
					echo "<li data-target=\"#carouselExampleIndicators\" data-slide-to=\".$i.\"></li>";
				}
			}

			echo "</ol><div class=\"carousel-inner\" role=\"listbox\"><div class=\"carousel-item active\"><a href=\"shop/".$bestsellers[0] -> product_id."\" ><img class=\"d-block img-fluid\" src=data:image/png;base64,".base64_encode($bestsellers[0] -> product_img)." alt=\"First slide\"></a></div>";

			for ($j = 1; $j < $size; $j++) {
				if ($j == 1){
					echo "<div class=\"carousel-item\"><a href=\"shop/".$bestsellers[$j] -> product_id."\" ><img class=\"d-block img-fluid\" src=data:image/png;base64,".base64_encode($bestsellers[$j] -> product_img)." alt=\"Second slide\"></a></div>";
				}
				elseif ($j == 2){
					echo "<div class=\"carousel-item\"><a href=\"shop/".$bestsellers[$j] -> product_id."\" ><img class=\"d-block img-fluid\" src=data:image/png;base64,".base64_encode($bestsellers[$j] -> product_img)." alt=\"Third slide\"></a></div>";
				}
			}

		}

		if ($size > 1){
			echo "</div><a class=\"carousel-control-prev\" href=\"#carouselExampleIndicators\" role=\"button\" data-slide=\"prev\"><span class=\"carousel-control-prev-icon\" aria-hidden=\"true\"></span><span class=\"sr-only\">Previous</span></a><a class=\"carousel-control-next\" href=\"#carouselExampleIndicators\" role=\"button\" data-slide=\"next\"><span class=\"carousel-control-next-icon\" aria-hidden=\"true\"></span><span class=\"sr-only\">Next</span></a></div>";
		} else {
			echo "</div></div></div>";
		}
		?>

		<div class="row">

			<?php
				foreach ($products as $product){
			$min = 0;
			$max = 1000;

			if(isset($_POST['min'])){
				if($_POST['min'] != ""){
					$min = $_POST['min'];
				}
			}
			
			if(isset($_POST['max'])){
				if($_POST['max'] != ""){
					$max = $_POST['max'];
				}
			}

			if($product->product_price >= $min && $product->product_price <= $max){
				$table = DB::table('category')->where('category_id',$product -> category_id_fk)->get();

				$category = $table[0];

				if (isset($_GET['category'])){
					if ($product -> category_id_fk == $_GET['category']){
						echo '<div class="col-lg-4 col-md-6 mb-4 product"><div class="card h-100"><a href="#">'; 
						if(isset($product -> product_img)){
							echo '<img class="card-img-top" src="data:image/png;base64,'.base64_encode($product -> product_img) .'" />'; 
						} else { 
							echo '<img class="card-img-top" src="'.asset('img/noimg.jpg'); 
							echo '" />';
						 }
						echo ' <div class="card-body black"><h4 class="card-title"><a href="#">';
						echo $product -> product_name;
						echo '</a></h4><h5>';
						echo $category -> category_name;
						echo '</h5><p>';
						echo $product -> product_desc;
						echo '</p></div><div class="card-footer black"><a class="btn btn-secondary" type="button" href="shop/add_'; echo $product -> product_id; echo'">Add to cart</a>Price : '.$product -> product_price.' €</div></div></div>';

					}
				} else {
					echo '<div class="col-lg-4 col-md-6 mb-4 product "><div class="card h-100"><a href="/shop/'.$product -> product_id.'">'; 
					if(isset($product -> product_img)){
						echo '<img class="card-img-top" src="data:image/png;base64,'.base64_encode($product -> product_img) .'" />'; 
					} else { 
						echo '<img class="card-img-top" src="'.asset('img/noimg.jpg'); 
						echo '" />';
					 }
					echo ' </a><div class="card-body black"><h4 class="card-title"><a href="/shop/'.$product -> product_id.'">';
					echo $product -> product_name;
					echo '</a></h4><h5>';
					echo $category -> category_name;
					echo '</h5><p>';
					echo $product -> product_desc;
					echo '</p></div><div class="card-footer black"><a class="btn btn-secondary" type="button" href="shop/add_'; echo $product -> product_id; echo'">Add to cart</a>Price : '.$product -> product_price.' €</div></div></div>';

				}
			}
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

