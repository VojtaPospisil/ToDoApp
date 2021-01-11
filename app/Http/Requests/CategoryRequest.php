<?php

namespace App\Http\Requests;

use App\Rules\notNumeric;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'  => [
                new notNumeric(),
                'string',
                'required',
                'max:255',
            ],
            'description' => [
                new notNumeric(),
                'string',
                'required',
            ]
        ];
    }
}
