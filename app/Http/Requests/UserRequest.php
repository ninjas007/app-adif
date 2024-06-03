<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'gender' => 'nullable|in:male,female',
            'birthday' => 'nullable|date_format:Y-m-d',
            'password' => [
                'nullable',
                'string',
                function ($attribute, $value, $fail) {
                    if ($value !== null) {
                        if (!Hash::check($value, auth()->user()->password)) {
                            $fail('The password you entered is incorrect.');
                        }
                    }
                },
            ],
            'password2' => ['nullable', 'string'],
        ];

        // check password not empty
        if (!empty($this->input('password'))) {
            $rules['password2'] = ['required', 'min:8', 'regex:/^(?=.*[a-z])(?=.*\d).+$/'];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required',
            'email.required' => 'The email field is required',
            'email.email' => 'Please enter a valid email address',
            'password2.required' => 'The new password field is required',
            'password2.min' => 'The new password must be at least 8 characters long',
            'password2.regex' => 'The new password contain at least one letter and one number',
        ];
    }
}
