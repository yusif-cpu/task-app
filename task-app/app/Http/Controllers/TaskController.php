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

    public function store(StoreTaskRequest $request)
    {
        $task = $this->taskService->createTask(
            $request->validated(),
            auth()->id()
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
}
