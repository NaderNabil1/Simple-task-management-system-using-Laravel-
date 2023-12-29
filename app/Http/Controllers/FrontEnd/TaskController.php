<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(){
        $tasks = Task::where('User', Auth::id())->get();
        return view('FrontEnd.Task.tasks', compact('tasks'));
    }

    public function show($slug){
        $task = Task::where('slug', $slug)->first();
        return view('FrontEnd.Task.show', compact('task'));
    }
}
