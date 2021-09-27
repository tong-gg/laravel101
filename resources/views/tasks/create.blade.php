@extends('layouts.main')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-center text-4xl py-4">Add new Task</h1>
        <form action="{{ route('tasks.store') }}" method="POST">
            {{-- laravel requires @csrf for method POST --}}
            @csrf
            <div>
                <label for="title">Title</label>
                <input type="text" name="title" autocomplete="off"
                       class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4 @error('title') border-red-400 @enderror"
                       placeholder="Title"
                value="{{ old('title') }}"/>
                @error('title')
                <p class="text-red-600">
                    {{ $message }}
                </p>
                @enderror
            </div>

            <div>
                <label for="detail">Detail</label>
                <textarea name="detail" id="detail" cols="30" rows="10"
                          class="w-full min-h-[100px] max-h-[300px] h-28 appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg  py-4 px-4 @error('detail') border-red-400 @enderror"
                >{{ old('detail') }}</textarea>
                @error('detail')
                <p class="text-red-600">
                    {{ $message }}
                </p>
                @enderror
            </div>

            <div>
                <label for="due_date">Due Date</label>
                <input type="datetime-local" name="due_date" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4 @error('due_date') border-red-400 @enderror"
                       value="{{ old('due_date') }}"/>
                @error('due_date')
                <p class="text-red-600">
                    {{ $message }}
                </p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="tags">Task Tags (separated with comma)</label>
                <input type="text" class="border p-2 w-full @error('tags') border-red-400 @enderror"
                    autocomplete="off" name="tags" value="{{ old('tags') }}">
                @error('tags')
                <p class="text-red-600">
                    {{ $message }}
                </p>
                @enderror
            </div>

            <div class="py-4">
                <button type="submit"
                        class="w-full sm:w-auto px-9 py-4  mb-4 text-base font-semibold transition-colors duration-200 rounded-md block border-b border-blue-300 bg-blue-200 hover:bg-blue-300 text-blue-700">
                    Add New Task
                </button>
            </div>
        </form>
    </div>
@endsection
