<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilterTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
//        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'  => [
                'string',
                'max:255',
            ],
            'description' => [
                'string',
                'max:255',
            ],
//            'category' => [
//                'required',
//            ],
            'mainCategory' => [
                'string',
                'numeric',
            ],
            'dueDateFrom' => [
                'date',
//                'format:Y-m-d|after: yesterday'
            ],
            'dueDateTo' => [
                'date',
//                'format:Y-m-d|after: yesterday'
            ],
            'user' => [
                'string',
                'numeric',
            ],
            'status' => [
                'string',
                'numeric',
            ],
            'page' => [
                'string',
                'numeric',
            ]
        ];
    }
}
