<?php

use App\Http\Controllers\Lists\PrivateListController;
use App\Http\Controllers\Lists\PublicListController;
use App\Http\Controllers\Lists\ThumbnailController;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;

Route::middleware(['auth', HandlePrecognitiveRequests::class])->group(function () {
    Route::get('profile/lists', [PrivateListController::class, 'index'])->name('profile.lists');
    Route::get('profile/lists/{list}', [PrivateListController::class, 'show'])->name('profile.lists.show');
    Route::get('profile/lists/{list}/edit', [PrivateListController::class, 'edit'])->name('profile.lists.edit');
    Route::patch('profile/lists/{list}/update', [PrivateListController::class, 'update'])->name('profile.lists.update');
    Route::get('lists/create', [PrivateListController::class, 'create'])->name('lists.create');
    Route::post('lists/store', [PrivateListController::class, 'store'])->name('lists.store');
    Route::post('profile/lists/{list}/thumbnail/update', [ThumbnailController::class, 'update'])->name('lists.updateThumbnail');
});

Route::get('{user}/lists', [PublicListController::class, 'index'])->name('user.lists');
