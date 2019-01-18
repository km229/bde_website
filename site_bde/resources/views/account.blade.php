@extends('template')

@section('title')
Ideas
@endsection

@section('body')
wtf
<div class="row">
    <div class="col-lg-3">
        <h1 class="my-4">My account</h1>
        <a href="/account/orders" class="list-group-item black">My orders</a>
        <a href="/account" class="list-group-item black">My informations</a>
    </div>
	<div class="col-lg-2">
		<p>Firstname :</p>
		<p>Lastname :</p>
		<p>Email :</p>
		<p>Location :</p>
	</div>
@endsection

