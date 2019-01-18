@extends('template')

@section('title')
Ideas
@endsection

@section('body')
	<h2 id="test">Suggestion box</h2>
	<article>	
		<p>Suggestion box allows students of the school to give event ideas to BDE members. Don't hesitate to add ideas !</p>
	</article>
	
<div class="row">

    <div class="col-lg-3">

        <h1 class="my-4">BDE CESI Saint-Nazaire</h1>
        <div class="card my-4">
            <h5 class="card-header">Search</h5>
            <div class="card-body">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                  <button class="btn btn-secondary" type="button">Go!</button>
                </span>
                </div>
            </div>
		</div>
		<div class="list-group">
            <a href="/ideas/create" class="list-group-item button">Create an idea</a>
        </div>
    </div>
    <!-- /.col-lg-3 -->

    <div class="col-lg-9">

        <div class="row">
    @foreach ($ideas as $idea)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body card-body2">
                    <h4 class="card-title">
                        <a href="#"><?php  echo $idea -> idea_title ?></a>
                    </h4>
                    <p><?php  echo $idea -> idea_desc ?></p>
                </div>
            </div>
        </div>
    @endforeach
        </div>
    </div>
@endsection

