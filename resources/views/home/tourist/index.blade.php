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

            <a href="/admin/tourist/create" class="btn">Tambah</a>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Nama</td>
                            <td>Kategori</td>
                            <td>Lokasi</td>
                            <td>Latitude</td>
                            <td>Longitude</td>
                            <td>Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tourists as $key => $tourist)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $tourist->name }}</td>
                                <td>{{ $tourist->category->name }}</td>
                                <td>{{ $tourist->location }}</td>
                                <td>{{ $tourist->latitude }}</td>
                                <td>{{ $tourist->longitude }}</td>
                                <td>
                                    <div class="action-container">
                                        <a class="btn" href="/admin/tourist/edit/{{ $tourist->id }}"><i class="bi bi-pencil-square"></i></a>
                                        <button class="btn delete-btn" data-id="{{ $tourist->id }}"><i class="bi bi-trash-fill"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
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
    <script src="/js/admin/tourist/script.js"></script>
@endsection