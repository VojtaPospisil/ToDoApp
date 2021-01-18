<?php

namespace App\Http\Requests;

use App\Rules\NotNumeric;
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
                new NotNumeric(),
                'string',
                'required',
                'max:255',
            ],
            'description' => [
                new NotNumeric(),
                'string',
                'required',
            ]
        ];
    }
}
