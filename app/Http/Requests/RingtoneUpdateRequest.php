<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RingtoneUpdateRequest extends FormRequest
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
             'title'=>"required|min:3|max:255|unique:ring_tones,title,$this->ringtone->id",
             'description'=>'required|min:3|max:255',
             'file'=>'mimes:mp3,mpga,wave|max:2000',
             'category_id'=>'required',
        ];
    }
}
