<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\BlogPostController;
use \App\Http\Controllers\RoleController;
use \App\Http\Controllers\HomeController;
use \App\Http\Controllers\CommentController;

require __DIR__.'/auth.php';

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('blog-posts', BlogPostController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('comments', CommentController::class);
});

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/{id}', [HomeController::class, 'show'])->name('home.show');
