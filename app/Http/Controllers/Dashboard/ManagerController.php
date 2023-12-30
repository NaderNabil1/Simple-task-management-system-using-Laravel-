<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware('manager');
    }
    public function index(){
        $managers = User::where('role','Manager')->get();
        return view('Dashboard.Manager.index', compact('managers'));
    }

    public function add(request $request){
        if($request->isMethod('post')){
            $request->validate([
                'first_name' => ['required', 'string'],
                'last_name' => ['required', 'string'],
                'email' => ['required', 'email', 'unique:users,email'],
                'phone' => ['required'],
                'password' => ['required'],
            ]);
            User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'role' => 'Manager',
            ]);
            return redirect()->route('be-managers');
        }
        return view('Dashboard.Manager.add');
    }

    public function edit(request $request, $id){
        $manager = User::find($id);
        if($request->isMethod('post')){
            $request->validate([
                'first_name' => ['required', 'string'],
                'last_name' => ['required', 'string'],
                'phone' => ['required'],
            ]);
            $manager->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'role' => $request->role,
            ]);
            return back();
        }
        return view('Dashboard.Manager.edit', compact('manager'));
    }

    public function delete($id){
        $manager = User::find($id);
        if($manager != NULL){
            $manager->delete();
        }
        return back();
    }
}
