@extends('template')

@section('title')
Cart
@endsection

@section('body')
<h1 class="my-4">My cart</h1>
<div class="row">



    <div class="col-lg-9">
        <div class="row">
        <?php
        $totalprice = 0;
        ?>
        @foreach($articles as $article)

            <?php

                echo '<div class="col-lg-4 col-md-6 mb-4 product"><div class="card bloc-link"><a href="/shop/'.$article -> product_id.'"></a>'; 
				if(isset($article -> product_img)){
					echo '<img class="card-img-top" src="data:image/png;base64,'.base64_encode($article -> product_img) .'" />'; 
				} else { 
					echo '<img class="card-img-top" src="'.asset('img/noimg.jpg').'" />';
				}
				echo '<div class="card-body card-body2"><h2 class="card-title">'.$article -> product_name.'</h2>'.
				'<p>'.$article -> product_desc.'</p></div>'.
                '<div class="card-footer card-body2"><h4 class="number">'.$article -> product_price.' €</h4></div>

                </div><div class="card-footer">Quantity : '.$article -> number.' 
                <a href="/shop/cart/plus_'.$article -> product_id.'" class="btn btn-secondary" style="background-color : dodgerblue; margin : 2px;""><i class="fas fa-plus"></i></a>
                <a href="/shop/cart/minus_'.$article -> product_id.'" class=" btn btn-secondary" style="background-color : dodgerblue; margin : 2px;"><i class="fas fa-minus"></i></a>
                <a href="/shop/cart/remove_'.$article -> product_id.'" class=" btn btn-secondary" style="background-color : indianred; margin : 2px;"><i class="far fa-trash-alt"></i></a></div></div>';
                $totalprice += $article -> product_price * $article -> number;

            ?>

        @endforeach
        </div>
    </div>

    <div class="col-lg-3">
        <div class="list-group card my-4 card-search">
            <h2 class="card-header ">Total</h2>
            <h3 class="list-group-item black"><?php echo $totalprice; ?> €</h3>
            <a href="cart/buy" class="list-group-item black btn btn-secondary">Buy</a>
        </div>
        <input type="checkbox" id="mentions"> I accept <a href="{{route('terms_conditions')}}">terms and conditions</a>
    </div>
    <!-- /.col-lg-3 -->

</div>
<!-- /.row -->
@endsection

