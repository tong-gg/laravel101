@extends('layouts.main')

@section('content')

    <h1 class="text-3xl">All Iamges</h1>

    <div>
        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Path</th>
            </tr>
            </thead>
            <tbody>
            @foreach($images as $image)
                <tr>
                    <td class="border px-2">{{ $image->name }}</td>
                    <td class="border px-2">
                        <a href="{{ route('images.show', [$image->path]) }}">
                            {{ $image->path }}
                        </a>
                    </td>
                    <td>
                        <img src="{{ url(\Str::replace('public/','storage/',$image->path)) }}" alt="image">
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
