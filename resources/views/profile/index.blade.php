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

            <div class="table-container">
                <form action="/admin/profile/edit" method="POST" id="profil-form" class="form-container">
                    @csrf
                    <h1>Edit profil</h1>
                    <label for="profile-img" class="profie-img-label">
                        <img id="preview-img" src="{{ auth()->user()->getFirstMediaUrl() != "" ? auth()->user()->getFirstMediaUrl() : "/img/profile/default.png" }}" alt="profile-image">
                        <input type="file" accept="image/*" style="display: none;" name="profile-img" id="profile-img">
                    </label>
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input required value="{{ auth()->user()->name }}" type="text" name="name" id="name" class="form-control">
                        @error('name')
                            <small class="error">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input required value="{{ auth()->user()->email }}" type="email" name="email" id="email" class="form-control">
                        @error('email')
                            <small class="error">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="address">Alamat</label>
                        <input required value="{{ auth()->user()->address }}" type="text" name="address" id="address" class="form-control">
                        @error('address')
                            <small class="error">{{ $message }}</small>
                        @enderror
                    </div>
                    <input type="hidden" name="latitude" id="latitude">
                    <input type="hidden" name="longitude" id="longitude">
                    <div class="form-group">
                        <button class="btn">Simpan</button>
                    </div>
                </form>
                
                <form action="/admin/profile/password" method="POST" id="password-form" class="form-container">
                    @csrf
                    <h1>Ganti password</h1>
                    <div class="form-group">
                        <label for="password">Password baru</label>
                        <input required value="" type="password" name="password" id="password" class="form-control">
                        @error('password')
                            <small class="error">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Konfirmasi password</label>
                        <input required value="" type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                        @error('password_confirmation')
                            <small class="error">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn">Simpan</button>
                    </div>
                </form>
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

@section('script')
    <script src="/js/admin/profile/script.js"></script>
@endsection