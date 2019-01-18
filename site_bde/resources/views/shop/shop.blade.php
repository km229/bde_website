@extends('template')

@section('title')
Shop
@endsection

@section('body')
<div class="row">

    <div class="col-lg-3">

        <h1 class="my-4">BDE CESI Saint-Nazaire</h1>
        <div class="card my-4">
            <h5 class="card-header black">Search</h5>
            <div class="card-body">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-secondary" type="button">Go!</button>
                  </span>
              </div>
          </div>
          <div>
            <a href="/shop/add/product" class="list-group-item black">Add product</a>
            <a href="/shop/add/category" class="list-group-item black">Add category</a>
        </div>
    </div>
    <div class="list-group">
        @foreach ($category as $cat)
        <a href="#" id="<?php echo $cat -> category_id ?>" class="list-group-item buttoncat"><?php echo $cat -> category_name ?></a>
        @endforeach

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
        <div class="col-lg-4 col-md-6 mb-4 item <?php  echo $product -> category_id_fk ?>">
            <div class="card h-100">
                <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
                <div class="card-body">
                    <h4 class="card-title">
                        <a href="#"><?php  echo $product -> product_name ?></a>
                    </h4>
                    <h5 class="black">Price : <?php  echo $product -> product_price ?>€</h5>
                    <p class="black"><?php  echo $product -> product_desc ?></p>
                </div>
                <div class="card-footer">
                    <button class="btn btn-secondary" type="button">Add to cart</button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>


@endsection

