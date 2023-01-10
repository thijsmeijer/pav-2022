<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable, HasSlug;

    protected $fillable = [
        'username',
        'slug',
        'email',
        'password',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('username')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function profile(): hasOne
    {
        return $this->hasOne(Profile::class);
    }

    public function lists(): HasMany
    {
        return $this->hasMany(UserList::class);
    }

    public function canAccessFilament(): bool
    {
        return $this->email == config('auth.filament.user.email') && $this->hasVerifiedEmail();
    }

    public function avatar(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->profile->getMedia('avatars')->first()
        );
    }

    public function password(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => bcrypt($value)
        );
    }
}
