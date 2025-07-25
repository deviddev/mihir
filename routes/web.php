<?php

declare(strict_types=1);

use App\Http\Controllers\MaterialController;
use App\Http\Controllers\UpdateUserTimezoneController;
use App\Livewire;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('m/{slug}', Livewire\Materials\Show::class)
            ->name('materials.show');

        Route::get('likes', Livewire\Materials\Likes::class)
            ->name('likes');

        Route::get('bookmarks', Livewire\Materials\Bookmarks::class)
            ->name('bookmarks');

        Route::view('settings', 'profile')
            ->name('settings');

        Route::get('publishers/{slug}', Livewire\Publishers\Show::class)
            ->name('publishers.show');
    });

Route::get('publishers/{slug}', Livewire\Publishers\Show::class)
    ->name('publishers.show');
Route::view('terms-and-conditions', 'terms')->name('terms');

Route::view('privacy-policy', 'privacy-policy')->name('privacy');

Route::get('feed/{type}', Livewire\FeedBySourceType::class)
    ->name('feed.type');

Route::get('/', Livewire\Materials\Index::class)->name('home');
Route::get('/{year}', Livewire\Materials\Index::class);
Route::get('/{year}/{month}', Livewire\Materials\Index::class);
Route::get('/{year}/{month}/{material:title_slug}', [MaterialController::class, 'show'])->name('home.material');

Route::post('update-timezone', UpdateUserTimezoneController::class)->name('timezone.update');
