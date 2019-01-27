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
			<a href="/account" class="list-group-item black">My informations</a>
			<a href="/account/orders" class="list-group-item black">My orders</a>
			<a href="/logout" class="list-group-item black">Logout</a>
		</div>
		<?php 
		if(isset($_SESSION)){
			$admin = DB::table('members')->where('member_id', $_SESSION['id'])->get();
			if(!empty($admin[0]) && $admin[0]->is_admin===1){
				echo '<div class="list-group card my-4 card-search"><a href="/admin" class="list-group-item black">Administration</a></div>';
			}
		}
		?>
	</div>
	<div class="col-lg-9">
		<h2>My informations</h2>
		<p>To change the password, you must fill in the old and new passwords and follow these conditions:
		<ul>
		<li class="eight">contain 8 characters</li>
		<li class="lowercase">contain a lowercase letter</li>
		<li class="capital">contain a capital letter</li>
		<li class="numbers">contain a number</li>
		</ul>
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
