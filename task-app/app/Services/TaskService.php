<?php

namespace App\Services;

use App\Models\Task;

class TaskService
{
    public function createTask($data, $userId)
    {
        return Task::create([
            'title' => $data['title'],
            'completed' => false,
            'user_id' => $userId
        ]);
    }

    public function getUserTasks($userId)
    {
        return Task::where('user_id', $userId)->get();
    }

    public function updateUserTask($data, $taskId, $userId)
    {
        $task = Task::where('id', $taskId)
            ->where('user_id', $userId)
            ->firstOrFail();

        $task->update([
            'title' => $data['title']
        ]);

        return $task;
    }

    public function destroyUserTask($taskId, $userId)
    {   
        $task = Task::where('id', $taskId)
                ->where('user_id', $userId)
                ->firstOrFail();

        $task->delete();

        return $task;
    }
}