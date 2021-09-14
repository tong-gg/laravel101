@extends('layouts.main')

@section('content')
    <div>
        <h1 class=" py-8 text-center text-5xl font-black font-bold">TODO LIST ID: {{ $task->id }}</h1>
    </div>

    <div class="mx-auto px-8 bg-white w-1/2 rounded-2xl">
        <div class="py-4">
            <h1 class="text-3xl italic">{{ $task->title }}</h1>
        </div>
        <div class="mt-2">
            Tags:
            @foreach($task->tags as $tag)
                <span class="inline-block p=2 ml-4">
                    <a href="{{ route('tags.slug', ['slug' => $tag->name]) }}">
                        {{ $tag->name }}
                    </a>
                </span>
            @endforeach
        </div>
        <div class="py-4">
            <h1 class="text-xl">Detail: {{ $task->detail }}</h1>
        </div>
        <div class="py-4">
            <h1 class="text-xl">{{ $task->due_date }}</h1>
        </div>
    </div>

    <div class="w-1/5 mx-auto py-2">
        <a href="{{ route('tasks.edit', ['task' => $task->id]) }}">
            <button class="w-full py-4 mb-4 text-base font-semibold transition-colors duration-200 rounded-md block border-b border-yellow-300 bg-yellow-200 hover:bg-yellow-300 text-yellow-700">
                Edit this task
            </button>
        </a>
    </div>
@endsection
