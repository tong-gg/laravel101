@extends('layouts.main')

@section('content')
    <h1 class="text-4xl text-center font-bold font-black">Edit Task: {{ $task->title }}</h1>

    <div class="container mx-auto">
        <form action="{{ route('tasks.update', ['task' => $task->id]) }}" method="POST">
            {{-- laravel requires @csrf for method POST --}}
            @csrf
            @method('PUT')
            <div>
                <label for="title">Title</label>
                <input type="text" name="title" autocomplete="off"
                       placeholder="Title" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4"
                       value="{{ $task->title }}"/>
            </div>

            <div>
                <label for="detail">Detail</label>
                <textarea name="detail" id="detail" cols="30" rows="10"
                          class="w-full min-h-[100px] max-h-[300px] h-28 appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg  py-4 px-4">{{ $task->detail }}</textarea>
            </div>

            <div>
                <label for="due_date">Due Date</label>
                <input type="datetime-local" name="due_date" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4"
                       value="{{ $task->due_date->format('Y-m-d\TH:i:s') }}"/>
            </div>

            <div class="mb-4">
                <label for="tags">Task Tags (separated with comma)</label>
                <input type="text" class="border p-2 w-full"
                       autocomplete="off" name="tags"
                value="{{ $task->tag_names }}">
            </div>

            <div class="w-1/5 my-5">
                <button type="submit"
                        class="w-full py-4 mb-4 text-base font-semibold transition-colors duration-200 rounded-md block border-b border-yellow-300 bg-yellow-200 hover:bg-yellow-300 text-yellow-700"
                >Edit Task</button>
            </div>
        </form>

        <hr>
        <div>
            <h1 class="text-4xl text-center font-bold text-red-500 underline">Danger Zone</h1>

            <h2 class="text-xl font-bold text-red-500 italic">Delete this task</h2>
            <p class="underline italic font-bold pb-4">This action CANNOT be undone</p>
            <form action="{{ route('tasks.destroy', ['task' => $task->id]) }}" method="POST">
                @csrf
                @method('DELETE')

                <label for="destroy">Type task's id to confirm</label>
                <div class="w-1/5">
                    <input type="text" placeholder="Type task's id" name="id" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded-lg h-10 px-4"/>
                </div>
                <div class="w-1/5 py-4">
                    <button type="submit"
                            class="w-full py-4 mb-4 text-base font-semibold transition-colors duration-200 rounded-md block border-b border-red-300 bg-red-200 hover:bg-red-300 text-red-700">
                    Delete</button>
                </div>
            </form>
        </div>
    </div>
@endsection
