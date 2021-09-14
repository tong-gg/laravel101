@extends('layouts.main')

@section('content')
    <div>
        <h1 class=" py-8 text-center text-5xl font-black font-bold">TAG ID: {{ $tag->id }}</h1>
    </div>

    <div class="mx-auto px-8 bg-white w-1/2 rounded-2xl">
        <div class="py-4">
            <h1 class="text-3xl italic">{{ $tag->name }}</h1>
        </div>
    </div>

    <!-- TODO: Show task with given tag -->
    @foreach($tag->tasks as $task)
        <div class="w-1/2 my-5 mx-auto">
            <a href="{{ route('tasks.show', ['task' => $task->id]) }}">
                <div class="p-6 bg-white flex items-center space-x-6 rounded-lg shadow-md hover:scale-105 transition transform duration-500 cursor-pointer">
                    <div>
                        <h1 class="text-xl font-bold text-gray-700 mb-2">{{ $task->title }}</h1>
                        <p class="text-gray-600 w-80 text-sm">{{ $task->detail }}</p>
                        <div>
                            {{ $task->created_at->diffForHumans() }}
                        </div>
                    </div>
                    <div>
                        {{ $task->due_date->calendar() }}
                    </div>
                </div>
            </a>
        </div>
    @endforeach
@endsection
