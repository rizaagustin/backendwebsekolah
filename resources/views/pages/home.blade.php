@extends('layouts.dashboard')
@section('content')
    <h1 class="text-center">Selamat Datang {{ Auth::user()->name }}</h1>
@endsection