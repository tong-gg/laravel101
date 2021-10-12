@extends("layouts.main")

@section('content')
    <div class="container mx-auto">
        <div class="mx-auto py-4">
            <h1 class="text-5xl text-center font-black font-bold">TODO LIST</h1>
        </div>
        <div class="w-1/5 mx-auto py-2">
            <a href="{{ route('tasks.create') }}">
                <button class="w-full py-4 mb-4 text-base font-semibold transition-colors duration-200 rounded-md block border-b border-blue-300 bg-blue-200 hover:bg-blue-300 text-blue-700">
                    + Add New Task
                </button>
            </a>
        </div>
            @foreach($tasks as $task)
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
        </div>
    </div>

    {{ $tasks->links() }}
@endsection


