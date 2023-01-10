<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'username' => ['required', 'string', 'max:255', 'min:3', Rule::unique('users'), 'alpha_dash'],
            'email' => ['required', 'string', 'regex:/[a-z0-9\.]+@([a-z0-9\-]+|\.{1})+\.[a-z0-9]+/', 'max:255', Rule::unique('users')],
            'password' => ['required', Password::defaults(), 'confirmed'],
            'password_confirmation' => ['required', 'same:password'],
        ];
    }
}
