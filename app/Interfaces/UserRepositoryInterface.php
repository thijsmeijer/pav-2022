<?php

namespace App\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{
    public function create($userData);

    public function update(User $user, array $newUserData);

    public function delete(User $user);
}
