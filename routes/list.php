<?php

use App\Http\Controllers\Lists\PrivateListController;
use App\Http\Controllers\Lists\PublicListController;
use Illuminate\Support\Facades\Route;

Route::get('/{user}/lists', [PublicListController::class, 'index'])->name('user.lists');

Route::get('/profile/my-lists', [PrivateListController::class, 'index'])->name('profile.lists');
