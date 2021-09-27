@extends('layouts.main')

@section('content')
    <h1>Add more room to apartment {{ $apartment->name }}</h1>

    <form action="{{ route('rooms.store') }}" method="POST">
        @csrf

        <input type="hidden" name="apartment_id" value="{{ $apartment->id  }}">
        <div>
            <label for="floor">Floor</label>
            <input type="number" name="floor"
           class="border-2 @error('floor') border-red-400 @enderror"
            value="{{ old('floor') }}"> / {{ $apartment->floors }}
            @error('floor')
                <p class="text-red-600">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div>
            <label for="name">Room Number</label>
            <input type="text" name="name" class="border-2 @error('name') border-red-400 @enderror"
            value="{{ old('name') }}">

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
                    <option value="{{ $type }}" {{ old('type') === $type ? "selected": "" }}>{{ $type }}</option>
                @endforeach
            </select>
            @error('type')
            <p class="text-red-600">
                {{ $message }}
            </p>
            @enderror
        </div>

        <div>
            <button type="submit">Add Room</button>
        </div>
    </form>
@endsection
