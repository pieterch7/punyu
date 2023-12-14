<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
</head>
<body>
@extends('template')
   @section('main')

<div id="about">
	<h2>About</h2>
	<p>Aplikasi <strong>laravelapp</strong> dibuat sebagai latihan 	untuk mempelajari Laravel.</p>
</div>
@stop

@section('footer')
@include('footer')
@stop

</body>
</html>