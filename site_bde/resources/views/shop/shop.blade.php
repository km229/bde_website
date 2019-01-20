@extends('template')

@section('title')
Shop
@endsection

@section('body')
<div class="row">

    <div class="col-lg-3">

        <h1 class="my-4">BDE CESI Saint-Nazaire</h1>
        <div class="card my-4">
            <h5 class="card-header card-search black">Search</h5>
            <div class="card-body">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-secondary" type="button">Go!</button>
                  </span>
              </div>
          </div>
          <div>
          </div>
      </div>
      <div class="list-group card my-4 card-search">
        <h5 class="card-header black">Categories</h5>
        <a href="/shop"  class="list-group-item buttoncat">All</a>
        @foreach ($category as $cat)
        <a href="?category=<?php echo $cat -> category_id ?>" class="list-group-item buttoncat"><?php echo $cat -> category_name ?></a>
        @endforeach


    </div>

    <div class="list-group card my-4 card-search">
        <h5 class="card-header black">Administration</h5>
        <a href="/shop/add/product" class="list-group-item black">New product</a>
        <a href="/shop/add/category" class="list-group-item black">New category</a>

    </div>




</div>
<!-- /.col-lg-3 -->

<div class="col-lg-9">

    <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
                <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="row">

        @foreach ($products as $product)
        <?php
        $table = DB::table('category')->get()->where('category_id',$product -> category_id_fk);

        $index = $table->keys()[0];

        $category = $table[$index];

        if (isset($_GET['category'])){
            if ($product -> category_id_fk == $_GET['category']){
                echo '<div class="col-lg-4 col-md-6 mb-4 product <?php  echo $product -> category_id_fk ?>"><div class="card h-100"><a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a><div class="card-body black"><h4 class="card-title"><a href="#">';
                echo $product -> product_name;
                echo '</a></h4><h5>';
                echo $product -> product_price;
                echo '€</h5><p>';
                echo $product -> product_desc;
                echo '</p></div><div class="card-footer black"><button class="btn btn-secondary" type="button">Add to cart</button>'.$category -> category_name.'</div></div></div>';

            }
        } else {


            echo '<div class="col-lg-4 col-md-6 mb-4 product <?php  echo $product -> category_id_fk ?>"><div class="card h-100"><a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a><div class="card-body black"><h4 class="card-title"><a href="#">';
            echo $product -> product_name;
            echo '</a></h4><h5>Price : ';
            echo $product -> product_price;
            echo '€</h5><p>';
            echo $product -> product_desc;
            echo '</p></div><div class="card-footer black"><button class="btn btn-secondary" type="button">Add to cart</button>'.$category -> category_name.'</div></div></div>';
            echo '';

        }
        ?>
        @endforeach
    </div>
</div>


@endsection

