<?php

namespace App\Interfaces;

use App\Models\Profile;
use App\Models\User;

interface ProfileRepositoryInterface
{
    public function updateAvatar(User $user, $file);

    public function update(Profile $profile, array $data);
}
