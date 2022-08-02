<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class projectRequest extends FormRequest
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
        return $validator = [
            'title'             => 'required|string|between:4,30',
            'description'       => 'required|string',
            'type'              => 'required|in:hourly,fixed',
            'budget'            => 'required|string ',
            'category_id'       => 'required|numeric ',
            'delivery_period'   => 'numeric',
            'skills'            => 'required|string',
            'tags'              => 'nullable|string',
        ];


    }
    //Option

    // public function messages()
    // {
    //     return [
    //         'title.required' =>'Title Is Required'
    //     ];
    // }
}
