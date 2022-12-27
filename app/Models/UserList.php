<?php

namespace App\Models;

use App\Enums\ListStatus;
use App\Models\Scopes\ListsScope;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class UserList extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'user_id',
        'name',
        'excerpt',
        'description',
        'status',
    ];

    protected $casts = [
        'status' => ListStatus::class,
    ];

    protected static function booted(): void
    {
        static::addGlobalScope(new ListsScope);
    }

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function thumbnail(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getMedia('thumbnails')->first()->getUrl()
        );
    }

    public function hasThumbnail(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getMedia('thumbnails')->first()
        );
    }
}
