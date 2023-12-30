<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(){
        $tasks = Task::where('user', Auth::id())->orderBy('status', 'desc')->get();
        $tasks = $tasks->sortBy(function ($item) {
            return $item->status == 'In Progress' ? 0 : 1;
        });
        return view('FrontEnd.Task.tasks', compact('tasks'));
    }

    public function show($slug,Request $request){
        $task = Task::where('slug', $slug)->first();
        if($request->isMethod('post')){
            $task->update([
                'status' => $request->status,
            ]);
            return back();
        }
        return view('FrontEnd.Task.show', compact('task'));
    }
}
