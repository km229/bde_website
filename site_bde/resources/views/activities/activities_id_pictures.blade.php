@extends('template')

@section('title')
Activities
@endsection

@section('body')
<?php 


$r = $_SERVER['REQUEST_URI']; 
$id2 = explode('_', $r)[1];
$table = DB::table('activity_pictures')->get()->where('picture_id', $id2);
$index = $table->keys()[0];
echo '<img class="w-100" src="data:image/png;base64,'.base64_encode($table[$index] -> picture_img) .'" />'; 


$table = DB::table('comment_picture_member')->join('members', 'member_id_fk','=','member_id')->where('picture_id_fk', $id2);

$table = $table->get();

foreach ($table as $el) {
    echo '
    <div class="row">
    <div class="col-sm-8">
    <div class="panel panel-white post panel-shadow">
    <div class="post-heading">
    <div class="pull-left meta">
    <div class="title h5">
    <a href="#"><b>'.$el->member_firstname.' '.$el->member_lastname.'</b></a>
    </div>
    <h6 class="text-muted time"> Published : '.$el->comment_date.'</h6>
    </div>
    </div> 
    <div class="post-description"> 
    <p>'.$el->comment.'</p>
    <div class="stats">
    <a href="#" class="btn btn-default stat-item">
    <i class="fa fa-thumbs-up icon"></i>
    </a>
    </div>
    </div>
    </div>
    </div>
    </div>
    ';
}

?>

<div class="container">
    {!! form($form) !!}
</div>
@endsection

