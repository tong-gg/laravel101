@extends('layouts.main')

@section('content')
    <hello></hello>
    <h1>Apartment List</h1>

    @can('create', \App\Models\Apartment::class)
    <a href="{{ route('apartments.create') }}">+ New Aprtment</a>
    @endcan

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Floors</th>
                <th>Rooms</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
        @foreach($apartments as $apartment)
            <tr>
                <td>
{{--                    งง --}}
                    <a href="{{ route('apartments.show', ['apartment' => $apartment->id]) }}">
                        {{ $apartment->name }}
                    </a>
                </td>
                <td>
                    {{ $apartment->floors }}
                </td>
                <td>
                    {{ $apartment->rooms->count() }}
                </td>
                <td title="{{ $apartment->created_at }}">
                    {{ $apartment->created_at->diffForHumans() }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
