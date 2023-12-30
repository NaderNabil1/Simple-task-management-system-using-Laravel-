<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Contracts\JWTSubject;

class UserController extends Controller
{
    public function index(Request $request){
        $token = $request->header('auth-token');
        if($token){
            $request->headers->set('auth-token', (string) $token, true);
            $request->headers->set('Authorization', 'Bearer '.$token, true);
            $currentUser = JWTAuth::parseToken()->authenticate();
            $users = User::where('role','User')->get();
            $data =  [];
            foreach($users as $user){
                $data[] = [
                    'user_name'=> $user->first_name . ' ' . $user->last_name,
                    'user_phone'=> $user->phone,
                    'user_role'=> $user->role,
                    'user_email'=> $user->email,
                ];
            }
            return response()->json(['users' => $users, 'status' => 200]);
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
                     'role' => 'User',
                ]);
                return response()->json(['status' => 200, 'message' => 'User added successfully']);
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

            $user = User::find($request->id);
            if($request->isMethod('post')){
                $request->validate([
                    'first_name' => ['required', 'string'],
                    'last_name' => ['required', 'string'],
                    'email' => ['required', 'email', 'unique:users,email'],
                    'phone' => ['required'],
                ]);


                $user->update([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                ]);
                return response()->json(['user' => $user, 'status' => 200, 'message' => 'User updated successfully']);
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

            $user = User::find($request->id);
            if(!$user){
                return response()->json(['status' => 404, 'message' => 'User not found']);
            } else {
                $user->delete();
                return response()->json(['status' => 200, 'message' => 'User deleted successfully']);
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
            $user = User::find($request->id);
            return response()->json(['user' => $user, 'status' => 200]);
        } else{
            return response()->json([
                'status' => 'error',
                'errors' => '401',
                'message' => 'Not Authorized'
            ], 401);
        }
    }
}
