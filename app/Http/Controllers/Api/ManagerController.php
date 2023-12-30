<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Contracts\JWTSubject;

class ManagerController extends Controller
{
    public function index(Request $request){
        $token = $request->header('auth-token');
        if($token){
            $request->headers->set('auth-token', (string) $token, true);
            $request->headers->set('Authorization', 'Bearer '.$token, true);
            $currentUser = JWTAuth::parseToken()->authenticate();

            $managers = User::where('role','Manager')->get();
            $data =  [];
            foreach($managers as $manager){
                $data[] = [
                    'manager_name'=> $manager->first_name . ' ' . $manager->last_name,
                    'manager_phone'=> $manager->phone,
                    'manager_role'=> $manager->role,
                    'manager_email'=> $manager->email,
                ];
            }
            return response()->json(['managers' => $data, 'status' => 200]);
        } else{
            return response()->json([
                'status' => 'error',
                'errors' => '401',
                'message' => 'Not Authorized'
            ], 401);
        }
    }

    public function add(request $request){
        $token = $request->header('auth-token');
        if($token){
            $request->headers->set('auth-token', (string) $token, true);
            $request->headers->set('Authorization', 'Bearer '.$token, true);
            $currentUser = JWTAuth::parseToken()->authenticate();

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
                return response()->json(['status' => 200, 'message' => 'Manager added successfully']);
            }
        } else{
            return response()->json([
                'status' => 'error',
                'errors' => '401',
                'message' => 'Not Authorized'
            ], 401);
        }
    }

    public function edit(request $request){
        $token = $request->header('auth-token');
        if($token){
            $request->headers->set('auth-token', (string) $token, true);
            $request->headers->set('Authorization', 'Bearer '.$token, true);
            $currentUser = JWTAuth::parseToken()->authenticate();

            $manager = User::find($request->id);
            if($request->isMethod('post')){
                $request->validate([
                    'first_name' => ['required', 'string'],
                    'last_name' => ['required', 'string'],
                    'email' => ['required', 'email', 'unique:users,email'],
                    'phone' => ['required'],
                ]);


                $manager->update([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                ]);
                return response()->json(['manager' => $manager, 'status' => 200, 'message' => 'Manager updated successfully']);
            }
        } else{
            return response()->json([
                'status' => 'error',
                'errors' => '401',
                'message' => 'Not Authorized'
            ], 401);
        }
    }

    public function delete(request $request){
        $token = $request->header('auth-token');
        if($token){
            $request->headers->set('auth-token', (string) $token, true);
            $request->headers->set('Authorization', 'Bearer '.$token, true);
            $currentUser = JWTAuth::parseToken()->authenticate();

            $manager = User::find($request->id);
            if(!$manager){
                return response()->json(['status' => 404, 'message' => 'Manager not found']);
            } else {
                $manager->delete();
                return response()->json(['status' => 200, 'message' => 'Manager deleted successfully']);
            }
        } else{
            return response()->json([
                'status' => 'error',
                'errors' => '401',
                'message' => 'Not Authorized'
            ], 401);
        }
    }

    public function show(request $request){
        $token = $request->header('auth-token');
        if($token){
            $request->headers->set('auth-token', (string) $token, true);
            $request->headers->set('Authorization', 'Bearer '.$token, true);
            $currentUser = JWTAuth::parseToken()->authenticate();
            $manager = User::find($request->id);
            return response()->json(['manager' => $manager, 'status' => 200]);
        } else{
            return response()->json([
                'status' => 'error',
                'errors' => '401',
                'message' => 'Not Authorized'
            ], 401);
        }
    }
}
