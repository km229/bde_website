@extends('template')

@section('title')
Ideas
@endsection

@section('body')
<div class="row">
    <div class="col-lg-3">
        <h1 class="my-4">My account</h1>
        <div class="list-group card my-4 card-search">
            <h5 class="card-header black">Navigation</h5>
            <a href="/account/orders" class="list-group-item black">My orders</a>
            <a href="/account" class="list-group-item black">My informations</a>
        </div>
    </div>
	<div class="col-lg-9">
		{!! form($form) !!}
</div>
@endsection

