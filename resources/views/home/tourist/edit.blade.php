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
        <h1>Edit data pariwisata</h1>
        <div class="card-container">
            <form class="form-container" action="/admin/tourist/edit" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" id="id" value="{{ $tourist->id }}">
                <div class="form-group">
                    <label for="name">Nama pariwisata</label>
                    <input class="form-control" type="text" name="name" id="name" value="{{ $tourist->name }}" required>
                    @error('name')
                        <small class="error">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="category">Kategori</label>
                    <select class="js-example-basic-single form-control" name="category_id" id="category">
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @if ($tourist->category->id == $category->id) selected @endif>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <small class="error">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <input class="form-control" type="text" name="description" id="description" value="{{ $tourist->description }}" required>
                    @error('description')
                        <small class="error">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <p>Thumbnail</p>
                    <div id="preview-container">
                        <div id="preview-img-container">
                            <img src="{{ $tourist->getFirstMediaUrl('thumb') != "" ? $tourist->getFirstMediaUrl('thumb') : '/img/tourist/default.png' }}" alt="thumb img" id="preview-img">
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
                    <input class="form-control" type="text" name="location" id="location" value="{{ $tourist->location }}" required>
                    @error('location')
                        <small class="error">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="latitude">Latitude</label>
                    <input class="form-control" type="text" name="latitude" id="latitude" value="{{ $tourist->latitude }}" required>
                    @error('latitude')
                        <small class="error">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="longitude">Longitude</label>
                    <input class="form-control" type="text" name="longitude" id="longitude" value="{{ $tourist->longitude }}" required>
                    @error('longitude')
                        <small class="error">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <h1>Preview pariwisata : </h1>
                    <div class="current-media-container">
                        @if ($tourist->getMedia('preview')->count() > 0)
                            {{-- <p>Gambar sebelumnya :</p> --}}
                            <div class="current-media">
                                @foreach ($tourist->getMedia('preview') as $media)
                                    {{ $media }}
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <label title="Klik untuk menambah gambar" for="tourist_preview" style="cursor: pointer;" id="preview-tourist-container">
                        <img src="/img/tourist/add.png" alt="preview pariwisata">
                    </label>
                    <p>Max : 2MB</p>
                    <input multiple class="form-control" style="display: none;" type="file" name="tourist_preview[]" id="tourist_preview" accept="image/*">
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