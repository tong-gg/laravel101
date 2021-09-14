@extends('layouts.main')

@section('content')
    <h1>Add New Apartment</h1>

    <form action="{{ route('apartments.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Apartment Name</label>
            <input type="text" name="name" autocomplete="off"
                   placeholder="Apartment Name">
        </div>

        <div>
            <label for="floors">Floors</label>
            <input type="number" name="floors" min="1">
        </div>

        <div>
            <button type="submit">Add New Apartment</button>
        </div>

    </form>

@endsection
