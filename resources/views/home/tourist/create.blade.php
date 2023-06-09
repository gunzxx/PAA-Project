@extends('layout.main')

@section('head')
    <link rel="stylesheet" href="/npm/select2/css/select2.css">
    <script src="/npm/select2/js/select2.full.js"></script>
    <link rel="stylesheet" href="/css/admin/style.css">
    <link rel="stylesheet" href="/css/admin/tourist/style.css">
    <link rel="stylesheet" href="/css/admin/form.css">
@endsection

@section('content')
    <main>
        <h1>Tambah data pariwisata</h1>
        <div class="card-container">
            <form class="form-container" action="/admin/tourist/create" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Nama pariwisata</label>
                    <input class="form-control" type="text" name="name" id="name" value="{{ old('name') }}" required>
                    @error('name')
                        <small class="error">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="category">Kategori</label>
                    <select class="js-example-basic-single form-control" name="category_id" id="category">
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <small class="error">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea class="form-control" type="text" name="description" id="description" required>{{ old("description") }}</textarea>
                    @error('description')
                        <small class="error">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <p>Thumbnail</p>
                    <div id="preview-container">
                        <div id="preview-img-container">
                            <img src="/img/tourist/default.png" alt="thumb img" id="preview-img">
                        </div>
                        <label class="btn" for="thumb">Unggah (Max : 2MB)</label>
                        <input class="form-control" style="display: none;" type="file" name="thumb" id="thumb" accept="image/*">
                    </div>
                    @error('thumb')
                        <small class="error">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="location">Lokasi</label>
                    <input class="form-control" type="text" name="location" id="location" value="{{ old('location') }}" required>
                    @error('location')
                        <small class="error">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="latitude">Latitude</label>
                    <input class="form-control" type="text" name="latitude" id="latitude" value="{{ old('latitude') }}" required>
                    @error('latitude')
                        <small class="error">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="longitude">Longitude</label>
                    <input class="form-control" type="text" name="longitude" id="longitude" value="{{ old('longitude') }}" required>
                    @error('longitude')
                        <small class="error">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <h1>Preview pariwisata : </h1>
                    <label title="Klik untuk menambah gambar" for="tourist_preview" style="cursor: pointer;" id="preview-tourist-container">
                        <img src="/img/tourist/add.png" alt="preview pariwisata">
                    </label>
                    <p>Max : 2MB</p>
                    <input required multiple class="form-control" style="display: none;" type="file" name="tourist_preview[]" id="tourist_preview" accept="image/*">
                    @error('tourist_preview')
                        <small class="error">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <button class="btn">Simpan</button>
                </div>
            </form>
        </div>
    </main>
@endsection

@section('script')
    <script src="/js/admin/tourist/edit.js"></script>
@endsection