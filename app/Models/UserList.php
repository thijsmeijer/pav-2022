<?php

namespace App\Models;

use App\Enums\ListStatus;
use App\Models\Scopes\ListsScope;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class UserList extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasSlug;

    protected $fillable = [
        'user_id',
        'name',
        'excerpt',
        'description',
        'status',
        'slug',
    ];

    protected $casts = [
        'status' => ListStatus::class,
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected static function booted(): void
    {
        static::addGlobalScope(new ListsScope);
    }

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function movies(): belongsToMany
    {
        return $this->belongsToMany(Movie::class)->withTimestamps();
    }

    public function thumbnail(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getMedia('thumbnails')->first()->getUrl()
        );
    }
}
