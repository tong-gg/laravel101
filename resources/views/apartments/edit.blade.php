@extends('layouts.main')

@section('content')
    <h1>Edit Apartment</h1>

    <form action="{{ route('apartments.update', ['apartment' => $apartment->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Apartment Name</label>
            <input type="text" name="name" autocomplete="off"
                   placeholder="Apartment Name"
                value="{{ $apartment->name }}"
            >
        </div>

        <div>
            <label for="floors">Floors</label>
            <input type="number" name="floors" min="1"
                   value="{{ $apartment->floors }}">
        </div>

        <div>
            <button type="submit">Edit Apartment</button>
        </div>
    </form>
    <hr>

    <div>
        <h1>Danger Zone</h1>
        <h2>Delete this apartment</h2>
        <p>THIS ACTION CANNOT BE UNDONE</p>
    {{-- form มี request ไปที่ controller เสมอ, สามารถใช้ request injection เป็น param แรกได้ เพื่อรับ request --}}
        <form action="{{ route('apartments.destroy', ['apartment' => $apartment->id]) }}" method="POST">
            @method('DELETE')
            @csrf

            <label for="destroy">Type apartment's name to confirm action</label>
            <input type="text" placeholder="apartment's name" name="name">
            <button type="submit">Delete</button>
        </form>
    </div>

@endsection
