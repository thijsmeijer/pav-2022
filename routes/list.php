<?php

use App\Http\Controllers\Lists\PrivateListController;
use App\Http\Controllers\Lists\PublicListController;
use App\Http\Controllers\Lists\ThumbnailController;
use App\Http\Controllers\Profile\AvatarController;
use App\Http\Controllers\Profile\ProfileController;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;

Route::middleware(['auth', HandlePrecognitiveRequests::class])->group(function () {
    Route::singleton('profile', ProfileController::class);
    Route::delete('/profile-delete', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('profile/avatar', [AvatarController::class, 'update'])->name('avatar.update');

    Route::get('/profile/my-lists', [PrivateListController::class, 'index'])->name('profile.lists');
    Route::get('/profile/lists/{list}', [PrivateListController::class, 'show'])->name('profile.list.show');
    Route::get('/lists/create', [PrivateListController::class, 'create'])->name('lists.create');
    Route::post('/lists', [PrivateListController::class, 'store'])->name('lists.store');
    Route::get('/lists/{list}/edit', [PrivateListController::class, 'edit'])->name('lists.edit');
    Route::patch('/lists/{list}/update', [PrivateListController::class, 'update'])->name('lists.update');
    Route::post('/thumbnail/{list}/update', [ThumbnailController::class, 'update'])->name('lists.updateThumbnail');
});

Route::get('/{user}/lists', [PublicListController::class, 'index'])->name('user.lists');
