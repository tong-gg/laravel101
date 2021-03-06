<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
</head>
<body>
    {{-- เอาส่วนเล็ก ๆ จากอีกหน้ามาใช้ --}}
    @include('layouts.menu')
    <div class="mx-auto min-h-screen bg-gray-100" id="app">
    {{-- @yield  เหมือนการเจาะช่อง เพื่อให้โค้ดหน้าอื่นมาใส่อยู่ในตำแหน่งนี้ได้--}}
        @yield('content')
    </div>
    <div>
        FOOTER
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>


