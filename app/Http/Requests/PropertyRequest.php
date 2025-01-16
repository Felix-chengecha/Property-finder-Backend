<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertyRequest extends FormRequest
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
            'name'=>['required', 'string', 'min:3', 'max:50'],
            'category' =>['required', 'integer'],
            'type'=>['required', 'string', 'min:3', 'max:50'],
            'cost'=>['required', 'integer'],       
            'owner_contact'=>['required','integer'],  
            'description' =>['required','string'],  
            'display'=>['required','string']  
        ];
    }
}
