<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Datetime;

class TaskController extends Controller
{
    public function index()
    {
        return view('tasks', [
            'tasks' => Task::paginate(10),
            'current_time' => new DateTime()
        ]);
    }
}
