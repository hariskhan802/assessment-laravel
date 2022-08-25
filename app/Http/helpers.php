<?php
	use App\Film;

	// Generate unique slug
    function make_slug($name, $number = 1){
        $slug = str_slug($name);
        if(Film::where(['slug' => $slug])->count() > 0) {
            return $this->make_slug($name.$number, $number + 1);
        }
        return $slug;
    }

    // Upload Image
    function upload_image($image) {
	    $file = $image;
        $extension = $file->getClientOriginalExtension();
        $filename = time().'-'.uniqid().'.'.$extension;
        $file->move('images', $filename);
        return $filename;	
    }