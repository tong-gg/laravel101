@extends('layouts.main')
@section('content')
    <h1 class="text-3xl">Upload Image</h1>
    <form action="{{ route('images.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="images">Select Image</label>
        <input type="file" name="image">
    </div>
    <div>
        <button type="submit">Upload</button>
    </div>
    </form>
@endsection
