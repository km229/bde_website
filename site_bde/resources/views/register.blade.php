@extends('template')

@section('title')
Sign up
@endsection

@section('body')
<h1>Register</h1>
<?php
	if(session('error')==="email_exists"){
		echo "<div class=\"alert alert-danger\">
		<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
		<strong>The email you provided already exists !</strong></div>";
	}
	if(session('error')==="mdp_error"){
		echo "<div class=\"alert alert-danger\">
		<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
		<strong>The password entered does not meet the conditions !</strong></div>";
	}
?>

<p>If you already have an account, <a href="login">please login here</a></p>

	<p>The password must :</p>
	<ul>
		<li class="eight">contain 8 characters</li>
		<li class="lowercase">contain a lowercase letter</li>
		<li class="capital">contain a capital letter</li>
		<li class="number">contain a number</li>
	</ul>


<div class="container">
	{!! form($form) !!}
</div>
@endsection


@section('script')
<script>
	$("#password").change(function(){
		$pass=$("#password").val();
		if ($pass.match(/[a-zA-Z\d]{8,}$/)){ $(".eight").css('color', 'green'); } 
		else { $(".eight").css('color', 'red'); };
		if ($pass.match(/[a-z]/)){ $(".lowercase").css('color', 'green'); } 
		else { $(".lowercase").css('color', 'red'); };
		if ($pass.match(/[A-Z]/)){ $(".capital").css('color', 'green'); } 
		else { $(".capital").css('color', 'red'); };
		if ($pass.match(/\d/)){ $(".number").css('color', 'green'); } 
		else { $(".number").css('color', 'red'); };
	});
</script>
@endsection