@extends('layout.main')

@section('content')
    <h1 class="text-xl text-[--g2] font-bold">Hello {{ auth()->user()->name }}</h1>

    <a class="logout">Logout</a>
    <a href="/">Landing</a>
@endsection