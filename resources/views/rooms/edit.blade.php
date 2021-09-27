@extends('layouts.main')

@section('content')
    <h1>Edit Room {{ $room->name }}</h1>
    <h1>Apartment {{ $room->apartment->name }}</h1>

    <form action="{{ route('rooms.update', ['room' => $room->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="floor">Floor</label>
            <input type="number" name="floor"
            value="{{ old('floor', $room->floor) }}"
            class="border-2 @error('floor') border-red-400 @enderror"> / {{ $room->apartment->floors }}
            @error('floor')
                <p class="text-red-600">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div>
            <label for="name">Room Number</label>
            <input type="text" name="name" value="{{ old('name', $room->name) }}"
                   class="border-2 @error('name') border-red-400 @enderror">
            @error('name')
            <p class="text-red-600">
                {{ $message }}
            </p>
            @enderror
        </div>

        <div>
            <label for="type">Room Type</label>
            <select name="type" id="type" class="border-2 @error('type') border-red-400 @enderror">
                @foreach($room_types as $type)
                    <option @if($type === old('type', $room->$type)) selected @endif
                        value="{{ $type }}">{{ $type }}</option>
                @endforeach
            </select>
            @error('type')
            <p class="text-red-600">
                {{ $message }}
            </p>
            @enderror
        </div>

        <div>
            <button type="submit">Edit room</button>
        </div>
    </form>
@endsection
