<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Http\Resources\TaskResource;
use App\Http\Resources\TaskListResource;
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
        $tasks = $this->taskService->getUserTasks(auth()->id());

        return TaskListResource::collection($tasks);
    }

    public function show($id)
    {
        $task = $this->taskService->getUserTask($id);

        return new TaskListResource($task);
    }

    public function store(StoreTaskRequest $request)
    {
        $task = $this->taskService->createTask(
            $request->validated()
        );
  
        return new TaskResource($task);
    }

    public function update(StoreTaskRequest $request, $id) 
    {
        $task = $this->taskService->updateUserTask(
            $request->validated(),
            $id,
            auth()->id()
        );

        return new TaskListResource($task);
    }

    public function destroy($id) 
    {
        $task = $this->taskService->destroyUserTask(
            $id,
            auth()->id()
        );

        return new TaskResource($task);
    }

    public function test()
    {
        $tasks = Task::with('user')->get();

        foreach ($tasks as $task)
        {
            $title[] = $task->user?->name;
            // $title[] = optional($task->user)->name;
        }

        // return Task::with('user')->paginate(5);
        return TaskResource::collection(Task::with('user')->where('user_id', auth()->id())->paginate(5));
    }
}
