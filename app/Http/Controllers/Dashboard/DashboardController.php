<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('manager');
    
    }
    public function index(){
        return view('Dashboard.Dashboard.index');
    }
}
