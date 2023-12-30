<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Validator;

class TaskController extends Controller
{
    public function index(Request $request){
        $token = $request->header('auth-token');
        if($token){
            $request->headers->set('auth-token', (string) $token, true);
            $request->headers->set('Authorization', 'Bearer '.$token, true);
            $currentUser = JWTAuth::parseToken()->authenticate();

            $tasks = Task::all();
            return response()->json(['tasks' => $tasks, 'status' => 200, 'message' => 'All Tasks']);
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

            $users = User::where('role','User')->get();

            if($request->isMethod('post')){
                $validator = Validator::make($request->all(),[
                    'title' =>'required|string',
                    'description' =>'required|string',
                    'user'=>'required',
                    'start_date'=>'required',
                    'end_date'=>'required',
                ]);
                $slug = Str::slug($request->title, '-');

                if( $request->has('file') ){
                    $file = $request->file;
                    $file_path = $file->storeAs('tasks', $slug . '-' . date('mdYHis') . '.' . $file->getClientOriginalExtension(), 'file');
                } else {
                    $file_path = NULL;
                }
                if($request->status == 'on') { $status = 'Completed'; } else { $status = 'In Progress'; }
                if($validator->fails()){
                    return response()->json($validator->messages(),400);
                }else{
                    Task::create([
                        'title' => $request->title,
                        'description' => $request->description,
                        'file' => $file_path,
                        'manager' => $currentUser->id,
                        'user' => $request->user,
                        'start_date' => $request->start_date,
                        'end_date' => $request->end_date,
                        'slug' => $slug,
                        'status' => $status,
                    ]);
                    return response()->json(['status' => 200, 'message' => 'Task added successfully']);
                }
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

            $task = Task::find($request->id);
            $users = User::where('role', 'User')->get();
            if($request->isMethod('post')){

                if( $request->has('file') ){
                    if($task->file != NULL){
                        unlink("uploads/".$task->file);
                    }
                    $file = $request->file;
                    $file_path = $file->storeAs('tasks', $slug . '-' . date('mdYHis') . '.' . $file->getClientOriginalExtension(), 'file');
                } else {
                    $file_path = $task->file;
                }

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
                return response()->json(['task' => $task, 'status' => 200, 'message' => 'Task updated successfully']);
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

            $task = Task::find($request->id);
            if(!$task){
                return response()->json(['status' => 404, 'message' => 'Task not found']);
            } else {
                if($task->file != NULL){
                    unlink("uploads/".$task->file);
                }
                $task->delete();
                return response()->json(['status' => 200, 'message' => 'Task deleted successfully']);
            }
        } else{
            return response()->json([
                'status' => 'error',
                'errors' => '401',
                'message' => 'Not Authorized'
            ], 401);
        }
    }
    public function show(Request $request){
        $token = $request->header('auth-token');
        if($token){
            $request->headers->set('auth-token', (string) $token, true);
            $request->headers->set('Authorization', 'Bearer '.$token, true);
            $currentUser = JWTAuth::parseToken()->authenticate();

            $tasks = Task::where('user',$currentUser->id)->get();
            $data =  [];
            foreach($tasks as $task){
                $data[] = [
                    'id'=> $task->id,
                    'title'=> $task->title,
                    'description'=> $task->description,
                    'file'=> $task->file,
                    'manager_assigned_task'=> $task->Manager->first_name . ' ' . $task->Manager->last_name,
                    'start_date'=> $task->start_date,
                    'end_date'=> $task->end_date,
                    'status'=> $task->status,
                ];
            }
            return response()->json(['tasks' => $data, 'status' => 200, 'message' => 'My Tasks']);
        } else{
            return response()->json([
                'status' => 'error',
                'errors' => '401',
                'message' => 'Not Authorized'
            ], 401);
        }
    }
    public function update(request $request,$taskId){
        $token = $request->header('auth-token');
        if($token){
            $request->headers->set('auth-token', (string) $token, true);
            $request->headers->set('Authorization', 'Bearer '.$token, true);
            $currentUser = JWTAuth::parseToken()->authenticate();
            $validator = Validator::make($request->all(), [
                'status' => 'required|in:Completed',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 422);
            }
            
            $task = Task::find($taskId);
            if (!$task) {
                return response()->json(['error' => 'Task not found'], 404);
            }
            $task->update(['status' => 'Completed']);
            if($task->user != $currentUser->id){
                return response()->json([
                    'status' => 'error',
                    'errors' => '401',
                    'message' => 'Not Authorized'
                ], 401);
            }
            return response()->json(['message' => 'Task status updated successfully'], 200);
        }
    }
}
