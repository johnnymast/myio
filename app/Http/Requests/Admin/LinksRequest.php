<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LinksRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'url' => 'required|max:200|url',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'url.required' => 'Url field cannot be blank',
            'url.max' => 'Url cannot be more than 200 characters',
            'url.url' =>  'The url format is invalid. Format expected - http(s)://(www).domain.com',
        ];
    }
}
