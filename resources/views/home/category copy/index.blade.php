@extends('layout.main')

@section('head')
    <link rel="stylesheet" href="/npm/select2/css/select2.css">
    <link rel="stylesheet" href="/css/admin/style.css">
    <script src="/npm/select2/js/select2.full.js"></script>
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
                <table>
                    <thead></thead>
                </table>
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
    <script src="/js/admin/script.js"></script>
@endsection