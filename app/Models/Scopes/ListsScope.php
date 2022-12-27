<?php

namespace App\Models\Scopes;

use App\Enums\ListStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class ListsScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder
            ->where(function ($query) {
                $query->where('user_id', auth()->id())
                    ->orWhereNot('status', ListStatus::Private);
            });
    }
}
