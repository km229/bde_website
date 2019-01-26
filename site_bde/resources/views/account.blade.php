@extends('template')

@section('title')
My informations | Account
@endsection

@section('body')
<div class="row">
	<div class="col-lg-3">
		<h1>My account</h1>
		<div class="list-group card my-4 card-search">
			<h5 class="card-header black">Navigation</h5>
			<a href="/account/orders" class="list-group-item black">My orders</a>
			<a href="/account" class="list-group-item black">My informations</a>
		</div>
		<p>To change the password, you must fill in the old and new passwords and follow these conditions:
		<ul>
		<li class="eight">contain 8 characters</li>
		<li class="lowercase">contain a lowercase letter</li>
		<li class="capital">contain a capital letter</li>
		<li class="numbers">contain a number</li>
		</ul>
	</div>
	<div class="col-lg-9">
		</p>
	
		{!! form($form) !!}
	</div>
@endsection

@section('script')
<script>
	$("#new_password").keyup(function(){
		$pass=$("#new_password").val();
		if ($pass.match(/[a-zA-Z\d]{8,}$/)){ $(".eight").css('color', 'green'); } 
		else { $(".eight").css('color', 'red'); };
		if ($pass.match(/[a-z]/)){ $(".lowercase").css('color', 'green'); } 
		else { $(".lowercase").css('color', 'red'); };
		if ($pass.match(/[A-Z]/)){ $(".capital").css('color', 'green'); } 
		else { $(".capital").css('color', 'red'); };
		if ($pass.match(/\d/)){ $(".numbers").css('color', 'green'); } 
		else { $(".numbers").css('color', 'red'); };
	});
</script>
@endsection
