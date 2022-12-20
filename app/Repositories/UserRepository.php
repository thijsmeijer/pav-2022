<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

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
        if($user->email !== $newUserData['email']) {
            $user->update([
                'email_verified_at' => null,
            ]);
        }

        $user->update([
            'username' => $newUserData['username'],
            'email' => $newUserData['email'],
        ]);

        $this->profileRepository->update($user->profile, $newUserData['profile']);
    }

    public function delete(User $user): ?bool
    {
        return $user->forceDelete();
    }
}
