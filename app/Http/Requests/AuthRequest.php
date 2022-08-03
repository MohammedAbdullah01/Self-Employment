<?php

namespace App\Http\Requests;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AuthRequest extends FormRequest
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
            'name'                  => 'required|string|unique:users,name|unique:clients,name|between:5,20',
            'email'                 => 'required|email|string|unique:users,email|unique:clients,email',
            'password'              => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
        ];

    }
}
