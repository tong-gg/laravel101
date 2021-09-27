@extends('layouts.main')

@section('content')
    <h1>Add New Apartment</h1>
    {{-- if there is any error, display this div (in case display all errors)--}}
    {{-- $errors, don't forget s letter --}}

    <form action="{{ route('apartments.store') }}" method="POST">
        @csrf
        <div>
        {{-- old('input's name attribute) retrives the old value after validation
            old takes two params, (input's name, default value)
            example in edit apartments
        --}}
            <label for="name">Apartment Name</label>
            <input type="text" name="name" autocomplete="off"
                   placeholder="Apartment Name" value="{{ old('name') }}"
            class="border-2 p-2 @error('name') border-red-400 @enderror">

            {{-- @error('input's name attribute) --}}
            @error('name')
            {{-- $message is in @error scope    --}}
                <div class="text-red-600">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div>
            <label for="floors">Floors</label>
            <input type="number" name="floors"
                   value="{{ old('floors') }}"
                   class="border-2 p-2 @error('floors') border-red-400 @enderror">
            @error('floors')
            {{-- $message is in @error scope    --}}
            <div class="text-red-600">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div>
            <button type="submit">Add New Apartment</button>
        </div>

    </form>

@endsection
