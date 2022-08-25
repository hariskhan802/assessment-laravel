<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Comment;
use Response;

class CommentController extends Controller
{
    
    // Post the Comment 
    public function post_comment(CommentRequest $request) {
    	try {
        	$response = ['status' => false, 'status_code' => 502, 'msg' => 'Something went wrong!'];
            $comment = Comment::create($request->all());
            if ($comment) {
            	$response = ['status' => true, 'status_code' => 201, 'msg' => 'Comment posted successfully!'];
            }
            return Response::json($response, $response['status_code']);
        }catch(\Exception $e){
            return  Response::json(['status' => false, 'status_code' => 500, 'msg' => $e->getMessage()], 500);
        }
    }
}
