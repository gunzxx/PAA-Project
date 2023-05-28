@extends('layout.main')

@section('head')
    <link href="/DataTables/datatables.min.css" rel="stylesheet"/>
    <script src="/DataTables/datatables.min.js"></script>
    <link rel="stylesheet" href="/css/admin/style.css">
    <link rel="stylesheet" href="/css/admin/category/style.css">
@endsection

@section('content')
    <main>
        <x-sidebar :active="$active"></x-sidebar>

        <div class="content">
            <div class="nav-content">
                <h1>Admin Site</h1>
                <p class="logout">Logout <i class="bi bi-box-arrow-right"></i></p>
            </div>

            <button type="button" class="btn btn-primary" id="modal-btn-add">Tambah</button>

            <div class="table-container">
                <table id="data-table" class="display">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Kategori</td>
                            <td>Aksi</td>
                        </tr>
                    </thead>
                    <tbody id="category-body">
                        @foreach ($categories as $index=>$category)
                            <tr>
                                <td class="no">{{ $index+1 }}.</td>
                                <td class="category-name">{{ $category->name }}</td>
                                <td>
                                    <div class="action-table">
                                        <button type="button" class="btn btn-edit" data-id="{{ $category->id }}"><i class="bi bi-pencil-square"></i></button>
                                        <button type="button" class="btn btn-delete" data-id="{{ $category->id }}"><i class="bi bi-trash-fill"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <div class="modal-container" id="modal-add">
        <div class="modal-bg"></div>
        <div class="modal-card">
            <form class="modal-form form-container" id="form-modal-add">
                <div class="form-group">
                    <label for="name">Nama Kategori</label>
                    <input required class="form-control" type="text" name="name" id="name">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal-container" id="modal-edit">
        <div class="modal-bg"></div>
        <div class="modal-card">
            <form class="modal-form form-container" id="form-modal-edit" action="/api/category">
                <div class="form-group">
                    <label for="name">Nama Kategori</label>
                    <input required class="form-control input-category-name" type="text" name="name">
                </div>
                <input required class="input-category-id" type="hidden" name="name">
                <div class="form-group">
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    @if (session()->has('error'))
        <x-alertError :message="session()->get('error')"></x-alertError>
    @endif

    @if (session()->has('success'))
        <x-alertSuccess :message="session()->get('success')"></x-alertSuccess>
    @endif
@endsection

@section('script')
    <script src="/js/admin/script.js"></script>
    <script src="/js/admin/category/script.js"></script>
@endsection