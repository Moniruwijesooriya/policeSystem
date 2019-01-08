<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CitizenUpdateForm extends FormRequest
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
            'email'=>'email|unique:users,email',
            'nic'=>'unique:users,nic',
            'password'=>'min:6|same:password_confirmation',


        ];
    }

    public function messages()
    {
        return[
            'email.email'=>'Invalid Email address',
            'email.unique'=>'This email address is already existed',
            'nic.unique'=>'This nic is already existed',
            'password.min'=>'Use 6 characters or more for your password',
            'password.same'=>'passwords did not match'
        ];
    }
}