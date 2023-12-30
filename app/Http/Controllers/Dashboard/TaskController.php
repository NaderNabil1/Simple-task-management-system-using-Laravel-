<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('manager');
    }
    public function index(){
        $tasks = Task::all();
        return view('Dashboard.Task.index', compact('tasks'));
    }
    public function add(request $request){
        $users = User::where('role', 'User')->get();
        $managers = User::where('role', 'Manager')->get();
        if($request->isMethod('post')){
            if( $request->status == 'on' ){ $status = 'Completed'; } else { $status = 'Pending'; }
            $slug = Str::slug($request->title, '-');
            $file = $request->file;
            if( $file != NULL ){
                $file_path = $file->storeAs('tasks', $slug . '-' . date('mdYHis') . '.' . $file->getClientOriginalExtension(), 'file');
            } else {
                $file_path = NULL;
            }

            $request->validate([
                'title' => ['required'],
            ]);

             Task::create([
                'title' => $request->title,
                'description' => $request->description,
                'file' => $file_path,
                'manager' => Auth::id(),
                'user' => $request->user,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'slug' => $slug,
                'status' => $status,
            ]);

            return redirect()->route('be-tasks');
        }
        return view('Dashboard.Task.add', compact('users', 'managers'));
    }

    public function edit(request $request, $id){
        $task = Task::find($id);
        $managers = User::where('role', 'Manager')->get();
        $users = User::where('role','User')->get();
        if($request->isMethod('post')){
            if( $request->status == 'on' ){ $status = 'Completed'; } else { $status = 'Pending'; }
            $slug = Str::slug($request->title, '-');
            $file = $request->file;
            if( $file != NULL ){
                $file_path = $file->storeAs('tasks', $slug . '-' . date('mdYHis') . '.' . $file->getClientOriginalExtension(), 'file');
            } else {
                $file_path = $task->file;
            }
            
            $request->validate([
                'title' => ['required'],
            ]);

            $task->update([
                'title' => $request->title,
                'description' => $request->description,
                'file' => $file_path,
                'user' => $request->user,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'slug' => $slug,
                'status' => $status,
            ]);
        }
        return view('Dashboard.Task.edit', compact('task', 'managers', 'users'));
    }
    public function delete($id){
        $task = Task::find($id);
        if($task != NULL){
            $task->delete();
        }
        return back();
    }
}
