<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $completedTasks = Task::where('status', '1')->paginate(10);
        $openTasks = Task::where('status', '0')->paginate(10);
        return view('tasks.index', compact(['completedTasks','openTasks']));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $task = new Task();
        $task->task_name = $request->title;
        $task->description = $request->description;
        $task->for = $request->for;
        $task->status = $request->status === 'open' ? '0' : '1';
        $task->taskable_id = $request->person_id;
        $task->taskable_type = $request->taskable_type;
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $task->update($validatedData);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function updateToOpenStatus(Task $task)
    {
        $task->status = 0;
        $task->save();

        return response()->json(['status' => $task->status === 1 ? 'Open' : 'Completed']);
    }

    public function updateToCompletedStatus(Task $task)
    {
        $task->status = 1;
        $task->save();

        return response()->json(['status' => $task->status === 1 ? 'Open' : 'Completed']);
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}