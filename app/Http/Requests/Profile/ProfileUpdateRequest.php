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
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'regex:/[a-z\.]+@([a-z0-9\-]+|\.{1})+\.[a-z0-9]+/', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
        ];
    }
}
