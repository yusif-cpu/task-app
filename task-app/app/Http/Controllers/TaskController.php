<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index() 
    {
        return [
            'Task: 1',
            'Task: 2',
            'Task: 3',
            'Task: 4',
            'Task: 5',
            ];
    }

    public function show($id) 
    {
        return "Task ID: " . $id;
    }
}
