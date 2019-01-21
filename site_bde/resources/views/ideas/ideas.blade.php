@extends('template')

@section('title')
Ideas
@endsection

@section('body')

<div class="row">

    <div class="col-lg-3">

        <h1 class="my-4">Idea box</h1>
        <p  class="my-4">Idea box allows students of the school to give event ideas to BDE members.</p>
        <p  class="my-4">Don't hesitate to add ideas !</p>
        <div class="card my-4">
            <h3 class="card-header black">Search</h3>
            <div class="card-body">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
              </div>
          </div>
      </div>
      <div class="list-group card my-4 card-search">
        <a href="/ideas/create" class="list-group-item black">New idea</a>

    </div>
</div>
<!-- /.col-lg-3 -->

<div class="col-lg-9">

    <div class="row">
    <?php
        if(sizeof($ideas)>0){
            echo '
            <div class="col-lg-4 col-md-6 mb-4 bloc-link">
            <div class="card h-100">
                <div class="card-body card-body2">
                    <h4 class="card-title">'. $idea -> idea_title .'</h4>
                    <p>'. $ideas[$i] -> idea_desc .'</p>
                </div>
                <a href="ideas/'.$ideas[$i]->idea_id.'"></a>
            </div>';
        } else {
            echo "<p>All ideas have been processed, feel free to add a new one <a href=\"ideas/create\">here</a>!";
        }
    ?>
    </div>
</div>
@endsection

