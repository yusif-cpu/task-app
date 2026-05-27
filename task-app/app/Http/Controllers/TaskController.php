<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Http\Resources\TaskResource;
use App\Http\Requests\StoreTaskRequest;

class TaskController extends Controller
{
    public function index() 
    {
        $tasks = Task::where('user_id', auth()->id())->get();

        // return response()->json([
        //     'data' => $tasks
        // ]);

        return TaskResource::collection($tasks);
    }

    public function store(StoreTaskRequest $request)
    {
        // $request->validate([
        //     'title' => 'required|max:255'
        // ]);
        
        $task = Task::create([
            'title' => $request->title,
            'completed' => false,
            'user_id' => auth()->id()
        ]);

        // return response()->json([
        //     'message' => 'Task created',
        //     'data' => $task
        // ]);

        return new TaskResource($task);
    }

    public function show($id) 
    {
        $task = Task::findOrFail($id);

        // return response()->json([
        //     'data' => $task
        // ]);

        return new TaskResource($task);
    }

    public function update(StoreTaskRequest $request, $id) 
    {
        $task = Task::findOrFail($id);

        if ($task->user_id !== auth()->id()) 
        {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        // $request->validate([
        //     'title' => 'required|max:255'
        // ]);

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

        if ($task->user_id !== auth()->id())
        {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        $task->delete();

        return response()->json([
            "Message" => 'Task ID: ' . $task->id . ' deleted'
        ]);
    }
}
