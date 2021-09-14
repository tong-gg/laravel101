<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::get();
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /**
         * $task
         * @param title, detail, due_date
         */
        // data is sent through form
        $task = new Task();
        $task->title = $request->input('title');
        $task->detail = $request->input('detail');
        $task->due_date = $request->input('due_date');
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        if ($task->id === $request->input('id')) {
            $task->delete();
            return redirect()->route('tasks.index');
        }
        return redirect()->back();
    }
}
