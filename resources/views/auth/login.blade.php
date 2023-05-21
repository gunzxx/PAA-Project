@extends('layout.main')

@section('head')
    <link rel="stylesheet" href="/css/auth/form.css">
@endsection

@section('content')
    <main>
        <div class="card-container">
            <h1>Login!</h1>

            <form action="/admin/login" method="POST" class="form-container">
                @csrf
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input name="email" type="email" class="form-control" id="email">
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input name="password" type="password" class="form-control" id="password">
                </div>
                <div class="form-group">
                    <button class="btn">Submit</button>
                </div>
            </form>
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
    <script src="/js/auth/login.js"></script>
@endsection