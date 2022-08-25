<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\FilmRequest;
use App\{
	Film,
	Country,
	Genre,
	FilmGenre,
};
use Response;
class FilmController extends Controller
{
    
    // Create the film
    public function create(FilmRequest $request) {
        try {
            $data = $request->except('genre_id');
        	$genre_ids = explode(',', $reques->genre_id);
        	$data['photo'] = upload_image($request['photo']);
        	$data['slug'] = make_slug($request->name);
            $response = ['status' => false, 'status_code' => 502, 'msg' => 'Something went wrong!'];
        	if($film = Film::create($data)) {
        		foreach ($genre_ids as $key => $genre_id) {
        			FilmGenre::create(['film_id' => $film->id, 'genre_id' => $genre_id]);
        		}
        		$response = ['status' => true, 'status_code' => 200, 'msg' => 'Film created successfully!'];
        	}
            return Response::json($response, $response['status_code']);
		}catch(\Exception $e){
            return  Response::json(['status' => false, 'status_code' => 500, 'msg' => $e->getMessage()], 500);
        }
    }
    
    // Get the records of films
    public function index() {
        try {
        	$data = Film::with(['genres' => function($query){
        		$query->select(['id', 'name']);
        	}, 'country' => function($query){
        		$query->select(['id', 'name']);
        	}])->orderBy('id', 'DESC')->paginate(1); 
            $response = ['status' => true, 'status_code' => 200, 'data' => $data ];
            return Response::json($response, $response['status_code']);
        }catch(\Exception $e){
            return  Response::json(['status' => false, 'status_code' => 500, 'msg' => $e->getMessage()], 500);
        }
    }

    // Get the single film
    public function film($slug) {
        try {
        	$data = Film::where(['slug' => $slug])->with(['comments' => function($query){
        		$query->select(['comment', 'film_id', 'id', 'created_at', 'user_id'])->orderBy('id', 'DESC');
        	}, 'comments.user:id,name', 'genres:id,name', 'country:id,name'])->first();
            $response = ['status' => true, 'status_code' => 200, 'data' => $data ];
            return Response::json($response, $response['status_code']);
        }catch(\Exception $e) {
            return  Response::json(['status' => false, 'status_code' => 500, 'msg' => $e->getMessage()], 500);
        }
    }
    
    // Get the countries
    public function get_countries() {
        try {
        	$data = Country::select(['id', 'name'])->get();
            $response = ['status' => true, 'status_code' => 200, 'data' => $data ];
            return Response::json($response, $response['status_code']);
        }catch(\Exception $e) {
            return  Response::json(['status' => false, 'status_code' => 500, 'msg' => $e->getMessage()], 500);
        }
    }

    // Get the genres
    public function get_genres() {
        try {
        	$data = Genre::select(['id', 'name'])->get();
            $response = ['status' => true, 'status_code' => 200, 'data' => $data ];
            return Response::json($response, $response['status_code']);
        }catch(\Exception $e) {
            return  Response::json(['status' => false, 'status_code' => 500, 'msg' => $e->getMessage()], 500);
        }
    }

    
}
