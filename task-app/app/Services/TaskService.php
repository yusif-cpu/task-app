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
}