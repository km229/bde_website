@extends('template')

@section('title')
Sign in
@endsection

@section('body')
<h1>Login</h1>

<p>If you do not have an account, <a href="register">click here</a></p>

<div class="container">
	{!! form($form) !!}
</div>

@endsection

