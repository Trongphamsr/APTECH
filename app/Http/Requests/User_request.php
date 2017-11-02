<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class User_request extends FormRequest
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
            'txtUser'=>'required|unique:users,name',
            'txtPass'=>'required',
            'txtRePass'=>'required|same:txtPass',
            'txtEmail'=>'required'
        ];
    }

    public function messages(){
        return[
            'txtUser.required' => 'please enter user name',
            'txtUser.unique'=>'please not enter duplicate',
            'txtPass.required'=>'please enter pass',
            'txtRePass.required'=>'please enter repass',
            'txtRePass.same'=>'please not enter same',
            'txtEmail'=>'please enter email'

        ];
    }
    
}
