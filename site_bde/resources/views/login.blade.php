@extends('template')

@section('title')
Sign in
@endsection

@section('body')
<h1>Login</h1>
<?php
	if(session('error')==="no_email"){
		echo "<div class=\"alert alert-danger\">
		<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
		<strong>No account exists with this email address !</strong></div>";
	}
	if(session('error')==="login_error"){
		echo "<div class=\"alert alert-danger\">
		<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
		<strong>Login problem: check your password !</strong></div>";
	}
?>

<p>If you do not have an account, <a href="register">click here</a></p>

<div class="container">
	{!! form($form) !!}
</div>

@endsection

