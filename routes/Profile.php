<?php

use App\Http\Controllers\Profile\AvatarController;
use App\Http\Controllers\Profile\ProfileController;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;

Route::middleware(['auth', HandlePrecognitiveRequests::class])->group(function () {
    Route::singleton('profile', ProfileController::class);
    Route::delete('profile/delete', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('profile/avatar/update', [AvatarController::class, 'update'])->name('profile.avatar.update');
});
