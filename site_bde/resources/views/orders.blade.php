@extends('template')

@section('title')
My orders
@endsection

@section('body')
<div class="row">
    <div class="col-lg-3">
        <h1 class="my-4">My orders</h1>
        <div class="list-group card my-4 card-search">
            <h5 class="card-header black">Navigation</h5>
            <a href="/account/orders" class="list-group-item black">My orders</a>
            <a href="/account" class="list-group-item black">My informations</a>
        </div>
    </div>
</div>
<div class="row">



    <div class="col-lg-9">
        <div class="row">
        <?php
        $totalprice = 0;
        ?>
        
        </div>
    </div>

    <div class="col-lg-3">


        <div class="list-group card my-4 card-search">
            <h2 class="card-header ">Total</h2>
            <h3 href="" class="list-group-item black"><?php echo $totalprice; ?> €</h3>
        </div>

    </div>
    <!-- /.col-lg-3 -->

</div>
<!-- /.row -->
@endsection


