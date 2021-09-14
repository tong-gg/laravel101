@extends('layouts.main')

@section('content')
    <h1 class="text-2xl font-bold text-gray-900 sm:text-3xl">Tags List</h1>

    <table>
        <thead>
        <tr>
            <th>Tag Name</th>
            <th>Number of tasks</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tags as $tag)
            <tr>
                <td>
                    <a href="{{ route('tags.slug', ['slug' => $tag->name]) }}">
                        {{ $tag->name }}
                    </a>
                </td>
                <td>
                    {{ $tag->tasks()->count() }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
