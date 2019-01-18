@extends('template')

@section('title')
Sign up
@endsection

@section('body')
<h1>Register</h1>

<p>If you already have an account, <a href="login">please login here</a></p>"


<p>The password must:</p>"

<div class="container">
	{!! form($form) !!}
</div>
@endsection
