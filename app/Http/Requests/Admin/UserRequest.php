<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        if (request()->route('user')) {
            return [
                'name' => 'required|max:255',
                'email' => [
                    'required',
                    Rule::unique('users')->ignore(request()->route('user')->id),
                    'max:255',
                ],
                'password' => 'required_with:password_again',
                'password_again' => 'required_with:password',
            ];
        } else {
            return [
                'name' => 'required|max:255',
                'email' => [
                    'required',
                    'unique:users',
                    'max:255',
                ],
                'password' => 'required',
                'password_again' => 'required_with:password',
            ];
        }
    }
}
