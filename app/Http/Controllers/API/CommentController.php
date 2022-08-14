<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Comment;
class CommentController extends Controller
{
    //
    public function post_comment(Request $request) {
    	$validator = \Validator::make($request->all(),[
            'comment' => 'required',
        ]);
    	$response = ['status' => false, 'status_code' => 502, 'msg' => 'Something went wrong!'];
        if($validator->fails()){
            return response($validator->messages(), 502);
        }
        $comment = Comment::create($request->all());
        if ($comment) {
        	$response = ['status' => true, 'status_code' => 201, 'msg' => 'Post comment successfully!'];
        }
        return response($response, $response['status_code']);
    }
}
