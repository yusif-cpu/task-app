<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Http\Resources\TaskResource;
use App\Http\Requests\StoreTaskRequest;
use App\Services\TaskService;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

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
        $task = $this->taskService->createTask(
            $request->validated(),
            auth()->id()
        );

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
