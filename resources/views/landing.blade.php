@extends('layout.main')

@section('head')
    <link rel="stylesheet" href="/css/landing/style.css">
@endsection

@section('content')
    <div class="overlay-1"></div>
    <img src="/img/logo.png" class="logo">
    <img src="/img/landing/overlay.png" class="overlay-2">

    <div class="text-container">
        <div class="title-container">
            <h1>Welcome to</h1>
            <div class="title">
                <h1>Pariwisata Jember</h1>
            </div>
        </div>

        <div class="subtitle">
            <p>Kunjungi berbagai destinasi pariwisata, hotel,</p>
            <p>dan tempat - tempat lain yang ada di Jember.</p>
        </div>
    </div>

    <div class="button-container">
        @if (auth()->check())
            <a href="/admin/home" class="btn"><i class="bi bi-house-door-fill"></i></a>
        @else
            <a href="/admin/login" class="btn">Login <i class="bi bi-arrow-right-circle-fill"></i></a>
        @endif
    </div>

    <div class="card-information">
        <h1>Berbagai Macam Wisata</h1>
        <p>Kami menyediakan berbagai informasi menarik di berbagai tempat yang ada di Jember</p>
        <img src="/img/landing/car.png">
    </div>

    <div class="destination-container">
        <img src="/img/landing/img1.png" class="img1">
        <img src="/img/landing/img2.png" class="img2">
        <img src="/img/landing/img3.png" class="img3">
    </div>
@endsection

@section('script')
    <script src="/js/landing/script.js"></script>
@endsection