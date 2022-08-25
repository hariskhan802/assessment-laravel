<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilmRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        
        return [
            //
            'name' => 'required',
            // 'slug' => 'required|unique:films',
            'description' => 'required',
            'release_date' => 'required',
            'rating' => 'required|numeric|min:1|max:5',
            'ticket_price' => 'required|numeric|min:1',
            'country_id' => 'required',
            'photo' => 'required|mimes:jpeg,jpg,png,gif|required|max:1000',
            'genre_id' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'country_id.required' => 'The country field is required.',
            'genre_id.required' => 'The genre field is required.',
        ];
    }
}
