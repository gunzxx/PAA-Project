@extends('layout.main')

@section('head')
    <link rel="stylesheet" href="/css/admin/style.css">
@endsection

@section('content')
    <main>
        <x-sidebar :active="$active"></x-sidebar>

        <div class="content">
            <div class="nav-content">
                <h1>Admin Site</h1>
                <p class="logout">Logout <i class="bi bi-box-arrow-right"></i></p>
            </div>

            <div class="card-profile">
                <div class="img-profile">
                    <img style="max-height: 100px;max-width: 100px;" src="{{ $user->getFirstMediaUrl('profile') != "" ? $user->getFirstMediaUrl('profile') : '/img/profile/default.png' }}" alt="Image Profile">
                </div>
                <div class="detail-profile">
                    <h1>Nama : {{ $user->name }}</h1>
                    <p>Email : {{ $user->email }}</p>
                    <p>Alamat : {{ $user->address }}</p>
                </div>
                <a title="Edit Profile" href="/admin/profile"><i style="font-size: 32px;"  class="bi bi-pencil-square"></i></a>
            </div>
        </div>
    </main>

    @if (session()->has('error'))
        <x-alertError :message="session()->get('error')"></x-alertError>
    @endif

    @if (session()->has('success'))
        <x-alertSuccess :message="session()->get('success')"></x-alertSuccess>
    @endif
@endsection