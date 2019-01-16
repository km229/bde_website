@extends('template')

@section('title')
<title> Sign in </title>
@endsection

@section('body')
<h1 class="d-none">Welcome back !</h1>

<form action="/" method="post">
    @csrf()
    <input type="text" placeholder="username or mail"/>
    <input type="password" placeholder="password"/>
    <button class="test">Submit</button>
    <script>$(.test).onclick(function {alert("mes couilles sur ton front ça marche");};)</script>
</form>

@endsection

