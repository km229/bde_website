@extends('template')

@section('title')
Sign in
@endsection

@section('body')
<h1 class="d-none">Welcome back !</h1>

<div class="container">
	{!! form($form) !!}
</div>

@endsection

