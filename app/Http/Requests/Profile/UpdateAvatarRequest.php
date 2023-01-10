<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAvatarRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'avatar' => ['nullable', 'image', 'max:10240'],
        ];
    }
}
