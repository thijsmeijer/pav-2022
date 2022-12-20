<?php

namespace App\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{
    public function getAllUsers();

    public function createUser($userData);

    public function updateUser(User $user, array $newUserData);

    public function deleteUser(User $user);

    public function updateAvatar(User $user, $file);
}
