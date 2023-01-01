<?php

namespace App\Http\Requests\Profile;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'username' => [
                ...$this->isPrecognitive()
                ? [Rule::unique('users')->ignore($this->user()->id), 'alpha_dash']
                : [
                    'required',
                    'string',
                    'min:3',
                    'max:16',
                    Rule::unique('users')->ignore($this->user()->id),
                ],
            ],
            'email' => [
                ...$this->isPrecognitive()
                ? [
                    Rule::unique(User::class)->ignore($this->user()->id),
                    'regex:/[a-z\.]+@([a-z0-9\-]+|\.{1})+\.[a-z0-9]+/',
                ]
                : [
                    'required',
                    'regex:/[a-z\.]+@([a-z0-9\-]+|\.{1})+\.[a-z0-9]+/',
                    Rule::unique(User::class)->ignore($this->user()->id),
                    'max:255',
                ],
            ],
            'profile' => [
                'name' => [
                    'nullable',
                    'string',
                    'max:50',
                ],
                'about' => [
                    'nullable',
                    'string',
                    'max:200',
                ],
            ],
        ];
    }
}
