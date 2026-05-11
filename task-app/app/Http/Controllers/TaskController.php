<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index() 
    {
        $tasks = Task::all();

        return response()->json([
            'data' => $tasks
        ]);
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
        $task = Task::findOrFail($id);

            return response()->json([
                'data' => $task
            ]);
    }

    public function update(Request $request, $id) 
    {
        $task = Task::findOrFail($id);

        $request->validate([
            'title' => 'required|max:255'
        ]);

        $task->update([
            'title' => $request->title
        ]);

        return response()->json([
            'message' => 'Task updated successfully',
            'data' => $task
        ]);
    }

    public function destroy($id) 
    {
        $task = Task::findOrFail($id);

        $task->delete();

        return response()->json([
            "Message" => 'Task ID: ' . $task->id . ' deleted'
        ]);
    }
}
