
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Testing</title>
</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data">
        {{ auth()->user()->getMedia('tes')->count() > 0 ? "oke" : "no" }}
        @foreach (auth()->user()->getMedia('tes') as $media)
            {{ $media->getUrl() }}
            <br>
        @endforeach
        @csrf
        <input name="tes[]" type="file" id="upload" multiple>
        <button>Submit</button>
        <div id="preview-container"></div>
    </form>

    <script>
        // Mendapatkan elemen input file
        const uploadInput = document.getElementById('upload');
        // Mendapatkan elemen container preview
        const previewContainer = document.getElementById('preview-container');

        // Event listener ketika ada perubahan pada input file
        uploadInput.addEventListener('change', function(e) {
        // Mendapatkan daftar file yang diunggah
        const files = e.target.files;
        
        // Meloopi setiap file untuk membuat preview
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const reader = new FileReader();

            // Event listener ketika file berhasil dibaca
            reader.onload = function(event) {
            // Membuat elemen gambar untuk preview
            const img = document.createElement('img');
            img.src = event.target.result;
            
            // Menambahkan gambar ke dalam container preview
            previewContainer.appendChild(img);
            }

            // Membaca file sebagai URL data
            reader.readAsDataURL(file);
        }
        });
    </script>
</body>
</html>