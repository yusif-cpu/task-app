<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index() 
    {
        return Task::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255'
        ]);
        
        $task = Task::create([
            'title' => $request->title,
            'completed' => false
        ]);

        return $task;
    }

    public function show($id) 
    {
        return Task::find($id);
    }

    public function update(Request $request, $id) 
    {
        $task = Task::find($id);

        $task->update([
            'title' => $request->title
        ]);

        return $task;
    }

    public function destroy($id) 
    {
        $task = Task::find($id);

        $task->delete();

        return response()->json([
            "Message" => 'Task ID: ' . $task->id . ' deleted'
        ]);
    }
}
