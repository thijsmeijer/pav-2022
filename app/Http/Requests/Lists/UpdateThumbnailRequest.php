<?php

namespace App\Http\Requests\Lists;

use Illuminate\Foundation\Http\FormRequest;

class UpdateThumbnailRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'thumbnail' => ['nullable', 'image', 'max:1024'],
        ];
    }
}
