<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Response;

class LoginRequest extends FormRequest
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
            'username'=>'required',
            'password'=>'required'
        ];
    }

    /**
    set Message
     **/
    public function messages()
    {
        return [
            'required'=>':attribute tidak Boleh Kosong'
        ];
    }

    /**
    Set Change Attribut
     **/
    public function attributes()
    {
        return [
            'username' => 'Username',
            'password' => 'Password'
        ];
    }

    protected function formatErrors(Validator $validator)
    {
        //$data['username'] = $validator->errors();
        return $validator->errors()->all();
    }

}
