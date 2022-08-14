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
class FilmController extends Controller
{
    //

    public function create(FilmRequest $request) {
    	$data = $request->except('genre_id');
    	$genre_ids = explode(',', $request->genre_id);
    	$data['photo'] = $this->upload_image($request['photo']);
    	$response = ['status' => false, 'status_code' => 502, 'msg' => 'Something went wrong!'];
    	if($film = Film::create($data)) {
    		foreach ($genre_ids as $key => $genre_id) {
    			// var_dump($film->id);
    			// var_dump($genre_id);
    			FilmGenre::create(['film_id' => $film->id, 'genre_id' => $genre_id]);
    		}
    		$response = ['status' => true, 'status_code' => 200, 'msg' => 'Film created successfully!'];
    	}
		return response()->json($response, $response['status_code']);
    }

    public function index() {
    	return Film::with(['genres' => function($query){
    		$query->select(['id', 'name']);
    	}, 'country' => function($query){
    		$query->select(['id', 'name']);
    	}])->orderBy('id', 'DESC')->paginate(1); 
    }
    public function film($slug) {
    	// dd(Film::find(1)->comments[0]->user);
    	return Film::where(['slug' => $slug])->with(['comments' => function($query){
    		$query->select(['comment', 'film_id', 'id', 'created_at', 'user_id'])->orderBy('id', 'DESC');
    	}, 'comments.user:id,name', 'genres:id,name', 'country:id,name'])->first(); 
    }
    
    public function get_countries() {
    	return Country::select(['id', 'name'])->get();
    }
    public function get_genres() {
    	return Genre::select(['id', 'name'])->get();
    }

    private function upload_image($image) {
	    $file = $image;
        $extension = $file->getClientOriginalExtension();
        $filename = time().'-'.uniqid().'.'.$extension;
        $file->move('images', $filename);
        return $filename;	
    }
}
