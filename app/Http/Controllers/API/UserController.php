<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; 
use Validator;
use App\User; 
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public function login(Request $request){
    	$response = ['status' => false, 'token' => '', 'status_code' => 401, 'msg' => 'Email or password is incorrect!'];
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password ])){ 
            $response = ['status' => true, 'token' => Auth::user()->createToken('MyApp')->accessToken, 'status_code' => 200, 'user' => Auth::user(), 'msg' => 'Logged in successfully'];
        } 
        return Response::json($response, $response['status_code']); 
        
    }

    public function register(UserRequest $request) 
    {
        $response = ['status' => false, 'token' => '', 'status_code' => 400, 'msg' => 'Something went wrong'];
        if ($user = User::create($request->validated())) {
            $response = ['status' => true, 'status_code' => 201, 'token' => $user->createToken('MyApp')->accessToken, 'msg' => 'Registration successfully!', 'user' => $user];
        }
		return response()->json($response, $response['status_code']);
    }
    public function logout() {
        $user = Auth::user()->token();
        $user->revoke();
        return 'logged out';
    }
}
