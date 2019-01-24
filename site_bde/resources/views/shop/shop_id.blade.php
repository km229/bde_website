@extends('template')

@section('title')
Shop
@endsection

@section('body')
<div class="container">
	<div class="row">
		<div class="col-lg-3">

			<h2 class="my-4">BDE CESI Saint-Nazaire</h2>
            <?php
			if(sizeof($_SESSION) > 0){
				$table = DB::table('members')->where('member_id', $_SESSION['id'])->get();


				if($table[0]->is_admin == 1){
			    echo '<div class="list-group card my-4 card-search">
                <h5 class="card-header black">Administration</h5>
                <a href="/shop/'.$id.'/update" class="list-group-item black">Update the product</a>
				<a href="/shop/{{$id}}/delete" class="list-group-item black">Delete</a>
				<a href="/shop" class="list-group-item black">Back</a>
            </div>';
                }
            }
            ?> 
                         
		</div>
		<div class="col-lg-9">

			<?php

			$r = $_SERVER['REQUEST_URI'];
			$id = explode('/', $r)[2];

			$table = DB::table('product')->get()->where('product_id',$id);
			$index = $table->keys()[0];

			$product = $table[$index];

			?>

			<!-- Portfolio Item Heading -->
			<h1 class="my-4">{{$product->product_name}}</h1>

			<!-- Portfolio Item Row -->
			<div class="card mt-4 card-body2">
            <?php echo '<img class="w-100" src="data:image/png;base64,'.base64_encode($product -> product_img) .'" />'; ?>
                <div class="card-body">
                    <h3 class="card-title">Price : {{$product->product_price}} €</h3>
                    <h4>{{$product->product_desc}}</h4>
                </div>
            </div>		
	</div>
</div>
@endsection

