<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(
        private ProfileRepository $profileRepository,
    ) {
    }

    public function create($userData): User
    {
        return User::create([
            'username' => $userData['username'],
            'email' => $userData['email'],
            'password' => bcrypt($userData['password']),
        ]);
    }

    public function update(User $user, array $newUserData): void
    {
        $user->update($newUserData);

        $this->profileRepository->update($user->profile, $newUserData['profile']);
    }

    public function delete(User $user): ?bool
    {
        return $user->forceDelete();
    }
}
