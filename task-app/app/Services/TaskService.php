<?php

namespace App\Services;

use App\Models\Task;
use App\Models\User;

class TaskService
{
    public function createTask($data, $image)
    {
        $path = null;

        if($image)
        {
            $path = $image->store('tasks', 'public');
        }

        return auth()->user()->tasks()->create([
            'title' => $data['title'],
            'image' => $path,
            'completed' => false
        ]);
    }

    public function getUserTasks($userId)
    {
        // return Task::where('user_id', $userId)->get();
        // return auth()->user()->tasks;
        // return Task::where('user_id', $userId)->get();
        return Task::ownedBy($userId)->get();
    }

    public function getUserTask($taskId)
    {
        // return auth()->user()->tasks()->where('id', $taskId)->firstOrFail();
        return Task::taskBy($taskId, auth()->id())->firstOrFail();
    }

    public function updateUserTask($data, $taskId, $userId)
    {
        $task = auth()->user()->tasks()->findOrFail($taskId);

        $task->update([
            'title' => $data['title']
        ]);

        return $task;
    }

    public function destroyUserTask($taskId, $userId)
    {   
        $task = auth()->user()->tasks()
                ->findOrFail($taskId);

        $task->delete();

        return $task;
    }
}