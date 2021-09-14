@extends('layouts.main')

@section('content')
    <h1>Add more room to apartment {{ $apartment->name }}</h1>

    <form action="{{ route('rooms.store') }}" method="POST">
        @csrf

        <input type="hidden" name="apartment_id" value="{{ $apartment->id  }}">
        <div>
            <label for="floor">Floor</label>
            <input type="number" min="1" max="{{ $apartment->floors }}"
                   name="floor"> / {{ $apartment->floors }}
        </div>

        <div>
            <label for="name">Room Number</label>
            <input type="text" name="name">
        </div>

        <div>
            <label for="type">Room Type</label>
            <select name="type" id="type">
                @foreach($room_types as $type)
                    <option value="{{ $type }}">{{ $type }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <button type="submit">Add Room</button>
        </div>
    </form>
@endsection
