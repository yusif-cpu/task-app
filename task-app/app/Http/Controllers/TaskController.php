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

    public function destroy($id) 
    {
        return Task::destroy($id);
    }
}
