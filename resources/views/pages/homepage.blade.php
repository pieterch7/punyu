<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
</head>
<body>
@extends('template')
@section('main')	
<div id="homepage">
	<h2>Homepage</h2>
	<p>Selamat belajar Laravel!</p>
</div>
@stop

@section('footer')
@include('footer')
@stop
</body>
</html>