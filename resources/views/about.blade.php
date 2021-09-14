{{-- using main layout --}}
{{-- dir: layouts, layout name: main => using dot notation--}}
{{-- เอา main layout มาใช้--}}
@extends('layouts.main')

{{-- same name as @yield --}}
@section('content')
    <h1>About Page</h1>
    <p>This is about page</p>
{{-- ใช้ key ในการเข้าถึง ไม่ใช้เลข index--}}
    <div>
        Contact: {{ $name }} ({{$info['email']}})
    </div>
{{-- to force process <script> from params you pass by, use {!! $var !!} --}}
    <div>
        {!! $info['address'] !!}
    </div>
@endsection
