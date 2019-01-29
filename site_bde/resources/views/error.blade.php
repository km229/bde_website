<?php
if(!isset($_SESSION)){
	session_start();
} 
?>

@extends('template')

@section('title')
Error
@endsection

@section('body')

<div>
<h1 class="my-4">Error {{ $exception->getStatusCode() }}</h1>


<h2 class="my-4">There is a problem with this page... </h2>
<h3 class="my-4">Retry or go to the <a href="/">homepage</a>.</h3>

@endsection
