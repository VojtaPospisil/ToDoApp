<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            'title'  => [
                'required',
                'string',
                'max:255',
            ],
            'description' => [
                'required',
                'string',
            ],
            'category' => [
                'required',
            ],
            'main_category' => [
                'required',
            ],
            'due_date' => [
                'required',
                'date',
//                'format:Y-m-d|after: yesterday'
            ],
            'user_id' => [
                'required',
            ],

        ];
    }
}
