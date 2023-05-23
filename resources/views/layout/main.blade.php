<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pariwisata Jember</title>
    
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/bs-icon/icon.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/main.css">
    <script src="/js/jquery.min.js"></script>
    <script src="/js/npm/swal2.js"></script>
    @yield('head')

</head>
<body>
    <div class="spinner-container">
        <div class="spinner"></div>
    </div>
    @yield('content')

    <script src="/js/jquery-validate.min.js"></script>
    <script src="/js/script.js"></script>
    @yield('script')
</body>
</html>