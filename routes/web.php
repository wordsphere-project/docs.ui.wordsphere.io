<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Pages\Docs\Content;
use App\Livewire\Pages\Docs\Index;
use App\Livewire\Pages\Home;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class);

Route::name('documentation.')->prefix('docs')->group(function () {
    Route::get('/getting-started', Index::class)
        ->name('index');

    Route::get('/{folder}/{slug}', Content::class);

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
