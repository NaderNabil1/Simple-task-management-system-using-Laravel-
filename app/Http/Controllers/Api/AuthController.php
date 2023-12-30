<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\Facades\JWTAuth;
use Validator;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'first_name' =>'required|string',
            'last_name' =>'required|string',
            'email'=>'required|string|email|unique:users',
            'password'=>'required|string|confirmed|min:6',
            'phone' => 'required', 'string', 'max:11','min:9', 'unique:users'
        ]);
        if($validator->fails()){
            return response()->json($validator->messages(),400);
        }else{
           $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'role' => 'User',
                'password' => Hash::make($request->password),
            ]);
            return response()->json([
                'message' => 'User successfully registered',
                'user' => $user
            ],201);
        }
    }
   public function login(request $request)
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user = User::where(['email' => $request->email])->first();
        $token = auth('api')->login($user);
        $user->api_token = $token;
        return response()->json([
            'access_token' => $token,
            'expires_in' => auth('api')->factory()->getTTL() * 5040,
            'token_type'=> 'bearer',
            'user_id'=> (string)$user->id,
            'user_name'=> $user->first_name . ' ' . $user->last_name,
            'user_phone'=> $user->phone,
            'user_role'=> $user->role,
        ]);
        
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
        ]);
    }
}
