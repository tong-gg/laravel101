<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Tag;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Auth::user()->tasks()->paginate    (10);
        return view('tasks.index', [
            "tasks" => $tasks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TaskRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
        /**
         * $task
         * @param title, detail, due_date
         */
        // data is sent through form
        $task = new Task();
        $task->title = $request->input('title');
        $task->detail = trim($request->input('detail'));
        $task->due_date = $request->input('due_date');
        $task->user_id = Auth::id();
//        $task->user_id = $request->user()->id
//        $task->user_id = Auth::user()->id;
        $task->save();


        $tags = trim($request->input('tags'));
        $this->updateTaskTag($task, $tags);

        return redirect()->route('tasks.index');
    }

    private function updateTaskTag($task, $tagsWithComma) {
        if ($tagsWithComma) {
            $tag_array = [];
            $tags = explode(",", $tagsWithComma);
            foreach ($tags as $tag_name) {
                $tag_name = trim($tag_name);
                if ($tag_name) {
                    $tag = Tag::firstOrCreate(['name' => $tag_name]);
                    array_push($tag_array, $tag->id);
                }
            }
            $task->tags()->sync($tag_array); // what does sync method do?
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.show', [
            'task' => $task
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.edit', [
            'task' => $task
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TaskRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskRequest $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->title = $request->input('title');
        $task->detail = $request->input('detail');
        $task->due_date = $request->input('due_date');
        $task->save();

        $tags = trim($request->input('tags'));
        $this->updateTaskTag($task, $tags);

        return redirect()->route('tasks.show', ['task' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param TaskRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaskRequest $request, $id)
    {
        $task = Task::findOrFail($id);
        if ($task->id === $request->input('id')) {
            $task->delete();
            return redirect()->route('tasks.index');
        }
        return redirect()->back();
    }
}
