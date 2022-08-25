<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; 
use App\User; 
use App\Http\Requests\UserRequest;
use Response;

class UserController extends Controller
{
    // Authenticate the user
    public function login(Request $request){
        try {
        	$response = ['status' => false, 'token' => '', 'status_code' => 401, 'msg' => 'Email or password is incorrect!'];
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password ])){ 
                $response = ['status' => true, 'token' => Auth::user()->createToken('MyApp')->accessToken, 'status_code' => 200, 'user' => Auth::user(), 'msg' => 'Logged in successfully'];
            } 
            return Response::json($response, $response['status_code']); 
        }catch(\Exception $e){
            return  Response::json(['status' => false, 'status_code' => 500, 'msg' => $e->getMessage()], 500);
        }
    }
    // Register the user
    public function register(UserRequest $request) 
    {
        try {
            $response = ['status' => false, 'token' => '', 'status_code' => 400, 'msg' => 'Something went wrong'];
            if ($user = User::create($request->validated())) {
                $response = ['status' => true, 'status_code' => 201, 'token' => $user->createToken('MyApp')->accessToken, 'msg' => 'Registration successfully!', 'user' => $user];
            }
    		return Response::json($response, $response['status_code']);
        }catch(\Exception $e){
            return  Response::json(['status' => false, 'status_code' => 500, 'msg' => $e->getMessage()], 500);
        }
    }
    // Logout the user
    public function logout() {
        try {
            $user = Auth::user()->token();
            $user->revoke();
            return  Response::json(['status' => true, 'status_code' => 200, 'msg' => 'Logout successfully'], 200);
        }catch(\Exception $e){
            return  Response::json(['status' => false, 'status_code' => 500, 'msg' => $e->getMessage()], 500);
        }
    }
}
