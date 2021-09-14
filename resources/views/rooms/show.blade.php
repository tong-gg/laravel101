@extends('layouts.main')

@section('content')
    <h1>
        Room {{ $room->type }}--{{ $room->name }}
    </h1>

    <div>
        Apartment: <span>
            <a href="{{ route('apartments.show', ['apartment' => $room->apartment->id]) }}">
                    {{ $room->apartment->name }}
            </a>
        </span>
    </div>
    <div>
        Floor: {{ $room->floor }}
    </div>

    <div>
        <a href="{{ route('rooms.edit', ['room' => $room->id]) }}">
            Edit this room
        </a>
    </div>

@endsection
