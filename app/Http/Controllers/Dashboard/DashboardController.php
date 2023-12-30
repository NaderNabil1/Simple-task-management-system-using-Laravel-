<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;


class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('manager');
    
    }
    public function index(){
        $unfinished_tasks = Task::where('status','Pending')->count();
        $finished_tasks = Task::where('status','Completed')->count();
        $users = User::where('role','User')->count();
        $managers = User::where('role','Manager')->count();
        return view('Dashboard.Dashboard.index',compact('unfinished_tasks','finished_tasks','users','managers'));
    }
}
