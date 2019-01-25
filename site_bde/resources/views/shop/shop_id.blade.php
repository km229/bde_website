@extends('template')

@section('title')
Shop
@endsection

@section('body')
<div class="container">
	<div class="row">
		<div class="col-lg-3">

		<?php

$uri = $_SERVER['REQUEST_URI'];
$id = explode('/', $uri)[2];

$table = DB::table('product')->where('product_id',$id)->get();
$product = $table[0];

?>
			<h2 class="my-4 card-title">Shop</h2>
            <?php
			if(sizeof($_SESSION) > 0){
				$table = DB::table('members')->where('member_id', $_SESSION['id'])->get();


				if($table[0]->is_admin == 1){
			    echo '<div class="list-group card my-4 card-search">
                <h5 class="card-header black">Administration</h5>
                <a href="/shop/'.$id.'/update" class="list-group-item black">Update the product</a>
				<a href="/shop/'.$id.'/delete" class="list-group-item black">Delete</a>
            </div>';
                }
            }
			?> 
			<h2>Price : <span class="number">{{$product->product_price}} €</span></h2>
            <div class="list-group card my-4 card-search">
				<a href="/shop/add_<?php echo $product->product_id; ?>" class="list-group-item black">Add to cart</a>
				<a href="/shop" class="list-group-item black">Back</a>
            </div>           
		</div>
		<div class="col-lg-9">

			<!-- Portfolio Item Heading -->
			<h1>{{$product->product_name}}</h1>

			<!-- Portfolio Item Row -->
			<div class="card mt-4 card-body2">
				
			<?php 
			if(isset($product -> product_img)){
				echo '<img class="card-img-top" src="data:image/png;base64,'.base64_encode($product -> product_img) .'" />'; 
			} else { 
				echo '<img class="card-img-top" src="'.asset('img/noimg.jpg'); 
				echo '" />';
			 }
			?>
                <div class="card-body">
					<h3>Description</h3>
                    <p>{{$product->product_desc}}</p>
                </div>
            </div>		
	</div>
</div>
@endsection

