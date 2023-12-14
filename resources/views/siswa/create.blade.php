@extends('template')
@section('main')
    <div id="siswa">
        <h2> Tambah Siswa </h2>

        {!! Form::open(['url' => 'siswa', 'files' =>true]) !!}
        {{ csrf_field() }}
        @include('siswa.form', ['submitButtonText' => 'Tambah Siswa'])
        {!! Form::close() !!}
    <div>

@stop
@section('footer')
    <div id="footer">
        <p>&copy; 2018 laravelapp.dev </p>
    <div>
@stop