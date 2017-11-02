<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Cate_request extends FormRequest
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
            'txtCateName'=>'required|unique:cates,name',
        ];
    }

    public function messages()
    {
        return[
            'txtCateName.required'=>'please enter txtCateName',
            'txtCateName.unique'=>'please enter not same name of txtCateName',
        ];
    }
}
