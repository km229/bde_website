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



            echo '<div class="col-lg-4 col-md-6 mb-4 product"><div class="card h-100"><a href="#">'; echo '<img class="card-img-top" src="data:image/png;base64,'.base64_encode($article -> product_img) .'" />'; echo ' <div class="card-body black"><h4 class="card-title"><a href="#">';
            echo $article -> product_name;
            echo '</a></h4><h5>';
            echo $article -> product_price;
            echo '€</h5><p>';
            echo $article -> product_desc;
            echo '</p></div><div class="card-footer black">Quantity : '.$article -> number.'<a href="http://localhost:8000/shop/cart/remove_'.$article -> product_id.'" class=" black btn btn-secondary">Remove</a></div></div></div>';
            $totalprice += $article -> product_price * $article -> number;


            ?>

        @endforeach
        </div>
    </div>

    <div class="col-lg-3">


        <div class="list-group card my-4 card-search">
            <h2 class="card-header ">Total</h2>
            <h3 href="" class="list-group-item black"><?php echo $totalprice; ?> €</h3>
            <a href="" class="list-group-item black btn btn-secondary">Buy</a>

        </div>

    </div>
    <!-- /.col-lg-3 -->

</div>
<!-- /.row -->
@endsection

