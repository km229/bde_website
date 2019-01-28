@extends('template')

@section('title')
Sign up
@endsection

@section('body')
<h1>Register</h1>

<p>If you already have an account, <a href="login">please login here</a></p>
<p>The password must :
	<ul>
		<li class="eight">contain 8 characters</li>
		<li class="lowercase">contain a lowercase letter</li>
		<li class="capital">contain a capital letter</li>
		<li class="number">contain a number</li>
	</ul>
</p>

<div class="container">
	{!! form($form) !!}
	<input type="checkbox" id="mentions"> I accept <a href="{{route('legal_terms')}}">legal conditions</a>
</div>
@endsection


@section('script')
<script>
	$("#password").keyup(function(){
		$pass=$("#password").val();
		if ($pass.match(/[a-zA-Z\d]{8,}$/)){ $(".eight").css('color', 'green'); } 
		else { $(".eight").css('color', 'red'); };
		if ($pass.match(/[a-z]/)){ $(".lowercase").css('color', 'green'); } 
		else { $(".lowercase").css('color', 'red'); };
		if ($pass.match(/[A-Z]/)){ $(".capital").css('color', 'green'); } 
		else { $(".capital").css('color', 'red'); };
		if ($pass.match(/\d/)){ $(".number").css('color', 'green'); } 
		else { $(".number").css('color', 'red'); };
	});
</script>
@endsection