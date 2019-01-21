@extends('template')

@section('title')
Activities
@endsection

@section('body')
<div class="container">

  <?php

  $r = $_SERVER['REQUEST_URI']; 
  $id = explode('/', $r)[2];

  $table = DB::table('activity')->get()->where('activity_id',$id);

  $index = $table->keys()[0];

  $activity = $table[$index];
  //dd($activity);
  ?>

  <!-- Portfolio Item Heading -->
  <h1 class="my-4">{{$activity->activity_title}}</h1>

  <!-- Portfolio Item Row -->
  <div class="row">

    <div class="col-md-8">
      <?php echo '<img class="w-100" src="data:image/png;base64,'.base64_encode($activity -> activity_img) .'" />'; ?>
    </div>

    <div class="col-md-4">
      <h3 class="my-3">Description</h3>
      <p>{{$activity->activity_desc}}</p>
      <h3 class="my-3">Date</h3>
      <p>{{$activity->activity_date}}</p>
    </div>

  </div>
  <!-- /.row -->

  <!-- Related Projects Row -->
  <h3 class="my-4">Related Projects</h3>

  <div class="row">

    <div class="col-md-3 col-sm-6 mb-4">
      <a href="#">
        <img class="img-fluid" src="http://placehold.it/500x300" alt="">
      </a>
    </div>

    <div class="col-md-3 col-sm-6 mb-4">
      <a href="#">
        <img class="img-fluid" src="http://placehold.it/500x300" alt="">
      </a>
    </div>

    <div class="col-md-3 col-sm-6 mb-4">
      <a href="#">
        <img class="img-fluid" src="http://placehold.it/500x300" alt="">
      </a>
    </div>

    <div class="col-md-3 col-sm-6 mb-4">
      <a href="#">
        <img class="img-fluid" src="http://placehold.it/500x300" alt="">
      </a>
    </div>

  </div>
  <!-- /.row -->

</div>
@endsection