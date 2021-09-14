@extends('layouts.main')

@section('content')
    <h1>Edit Room {{ $room->name }}</h1>
    <h1>Apartment {{ $room->apartment->name }}</h1>

    <form action="{{ route('rooms.update', ['room' => $room->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="floor">Floor</label>
            <input type="number" min="1" max="{{ $room->apartment->floors }}"
                   name="floor"
            value="{{ $room->floor }}"> / {{ $room->apartment->floors }}
        </div>

        <div>
            <label for="name">Room Number</label>
            <input type="text" name="name" value="{{ $room->name }}">
        </div>

        <div>
            <label for="type">Room Type</label>
            <select name="type" id="type">
                @foreach($room_types as $type)
                    <option @if($type === $room->$type) selected @endif
                        value="{{ $type }}">{{ $type }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <button type="submit">Edit room</button>
        </div>
    </form>
@endsection
