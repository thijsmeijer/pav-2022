<?php

namespace App\Http\Requests\Lists;

use App\Enums\ListStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class UpdateListRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:25', Rule::unique('user_lists', 'name')->ignore($this->list)],
            'description' => ['required', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string', 'max:50'],
            'status' => ['required', 'string', new Enum(ListStatus::class)],
        ];
    }
}
