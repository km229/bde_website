@extends('template')

@section('title')
My orders
@endsection

@section('body')
<div class="row">
    <div class="col-lg-3">
        <h1 class="my-4">My orders</h1>
            <a href="/account/orders" class="list-group-item black">My orders</a>
            <a href="/account" class="list-group-item black">My informations</a>
        </div>
    </div>
</div>
@endsection

