<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\UploadedFile;

class UserService
{
    public function create($userData): User
    {
        return User::create([
            'username' => $userData['username'],
            'email' => $userData['email'],
            'password' => $userData['password'],
        ]);
    }

    public function update(array $newUserData): void
    {
        auth()->user()->update($newUserData);

        auth()
            ->user()
            ->profile
            ->update($newUserData['profile']);
    }

    public function updateAvatar(UploadedFile $file): void
    {
        auth()
            ->user()
            ->profile
            ->clearMediaCollection('avatars')
            ->addMedia($file)
            ->toMediaCollection('avatars', 'media.avatars');
    }
}
