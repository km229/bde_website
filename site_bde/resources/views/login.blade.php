@extends('template')

@section('title')
<title> Sign in </title>
@endsection

@section('body')
<h1 class="d-none">Welcome back !</h1>

<div class="container">
    {!! form($form) !!}
</div>

@endsection

