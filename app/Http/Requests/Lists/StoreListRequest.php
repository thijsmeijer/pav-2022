<?php

namespace App\Http\Requests\Lists;

use Illuminate\Foundation\Http\FormRequest;

class StoreListRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:25'],
            'description' => ['required', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string', 'max:50'],
            'thumbnail' => ['nullable', 'image', 'max:1024'],
        ];
    }
}
