@extends('layouts.main')

@section('content')
    <h1>Apartment</h1>

    <h2>{{ $apartment->name }}</h2>

    <p>
        จำนวนชั้น {{ $apartment->floors }} ชั้น
    </p>

    <hr>

    <a href="{{ route('apartments.edit', ['apartment' => $apartment->id]) }}">Edit this apartment</a>

    <div>
        Rooms in This Apartment
    </div>
    <div>
        <a href="{{ route('apartments.rooms.create', ['apartment' => $apartment->id]) }}">
            + Add More Room
        </a>
    </div>

    <div>
        <ul>
            @foreach($apartment->rooms->sortBy('floor') as $room)
                <li>
                    <a href="{{ route('rooms.show', ['room' => $room->id]) }}">
                    {{ $room->type }} - {{ $room->name }}
                    </a>
                    Floor {{ $room->floor }}
                </li>

            @endforeach
        </ul>
    </div>
@endsection
