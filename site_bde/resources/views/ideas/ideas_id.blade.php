@extends('template')

@section('title')
{{ $idea[0] -> idea_title }}
@endsection

@section('body')

<div class="container">
	<div class="row">
		<div class="col-lg-3">

			<h2 class="my-4">Idea box</h2>
            
			<div class="list-group card my-4 card-search">
				<h5 class="card-header black">Administration</h5>
                <?php
                echo '<a href="/ideas/'.$idea[0]->idea_id.'/update" class="list-group-item black">Update idea</a>
				<a href="/ideas/'.$idea[0]->idea_id.'/delete" class="list-group-item black">Delete idea</a>';
                ?>
				<a href="/ideas" class="list-group-item black">Back</a>
			</div>

		</div>
		<div class="col-lg-9">

			
			<!-- Portfolio Item Heading -->
			<h1 class="my-4">{{ $idea[0]->idea_title }}</h1>

				<div class="col-md-4">
					<h3 class="my-3">Description</h3>
					<p>{{ $idea[0]->idea_desc }}</p>
					<h3 class="my-3">Likes</h3>
                    <div class="button">
                    <a>{{ $like[0]->idea_likes }}</a>
                    <?php
                        
                    ?>
                    </div>
				</div>
		</div>
        
	</div>
</div>

@endsection