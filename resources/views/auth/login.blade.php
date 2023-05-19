@extends('layout.main')

@section('content')
    <h1 class="text-xl text-[--g2] font-bold">
        Login!
    </h1>
    <div class="container" class="w-[100vw] h-[100vh] bg-orange-500">
        <form action="/login" method="POST">

        </form>
    </div>
@endsection

@section('script')
    <script src="/js/auth/login.js"></script>
@endsection