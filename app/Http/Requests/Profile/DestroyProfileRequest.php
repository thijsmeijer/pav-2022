<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class DestroyProfileRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'password' => ['required', 'current-password'],
        ];
    }
}
