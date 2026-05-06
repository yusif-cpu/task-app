<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index() 
    {
        Task::create([
            'title' => 'Learn Laravel',
            'completed' => false
        ]);

        return Task::all();
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
