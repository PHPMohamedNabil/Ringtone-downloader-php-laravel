<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhotoUpdateRequest extends FormRequest
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
             'title'=>"required|min:3|max:255|unique:photos,title,$this->photo->id",
             'description'=>'required|min:3|max:255',
             'image'=>'mimes:jpg,jpeg,png|max:3000',
             
        ];
    }
}
