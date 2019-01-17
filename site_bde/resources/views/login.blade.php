@extends('template')

@section('title')
Sign in
@endsection

@section('body')
<h1>Welcome back !</h1>

<div class="container">
	{!! form($form) !!}
</div>

@endsection

