<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Profile extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'name',
        'date_of_birth',
        'phone',
        'phone_verified_at',
        'bio',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'phone_verified_at' => 'datetime',
    ];

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }
}
