<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{
    public function getAllUsers(): Collection
    {
        return User::all();
    }

    public function createUser($userData)
    {
        return User::create($userData);
    }

    public function updateUser(User $user, array $newUserData): bool
    {
        if ($user->emailIsDirty($newUserData['email'])) {
            $user->email_verified_at = null;
        }

        return $user->update($newUserData);
    }

    public function deleteUser(User $user): ?bool
    {
        return $user->delete();
    }
}
