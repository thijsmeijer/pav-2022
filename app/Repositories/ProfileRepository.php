<?php

namespace App\Repositories;

use App\Interfaces\ProfileRepositoryInterface;
use App\Models\Profile;
use App\Models\User;

class ProfileRepository implements ProfileRepositoryInterface
{
    public function update(Profile $profile, array $data)
    {
        $profile->update($data);
    }

    public function updateAvatar(User $user, $file)
    {
        $user
            ->profile
            ->clearMediaCollection('avatars')
            ->addMedia($file)->toMediaCollection('avatars', 'media.avatars');
    }
}
