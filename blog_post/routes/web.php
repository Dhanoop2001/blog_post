<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

Route::get('/', [RegisterController::class, 'showRegistrationForm']);

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/signin', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.store');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

// Forgot Password & Reset
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [NewPasswordController::class, 'show'])->name('password.reset');
Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.store');

// Public Blogs
Route::get('/blogs/all', [BlogController::class, 'publicIndex'])->name('blogs.all')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/blog', [BlogController::class, 'create'])->name('blog');
    Route::post('/blogs', [BlogController::class, 'store'])->name('blogs.store');
    Route::post('/blog/slug', [BlogController::class, 'generateSlug'])->name('blog.slug');
    Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
    
    Route::get('/blogs/{blog}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
    Route::get('/blogs/{blog}', [BlogController::class, 'show'])->name('blogs.show');
    Route::put('/blogs/{blog}', [BlogController::class, 'update'])->name('blogs.update');
    Route::delete('/blogs/{blog}', [BlogController::class, 'destroy'])->name('blogs.destroy');
});
