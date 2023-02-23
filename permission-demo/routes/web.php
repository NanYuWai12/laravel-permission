<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/posts', [PostController::class, 'index'])->name('post.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('post.create')->middleware('can:create posts');
    Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('post.edit')->middleware('can:edit posts');
    Route::get('/posts/{id}', [PostController::class, 'show'])->name('post.show')->middleware('can:view posts');

    Route::middleware('role:admin')->group(function () {
        Route::get('/roles', [RolesController::class, 'index'])->name('roles.index');
        Route::get('/roles/create', [RolesController::class, 'create'])->name('roles.create');
        Route::post('/roles', [RolesController::class, 'store'])->name('roles.store');
        Route::get('/roles/{id}/edit', [RolesController::class, 'edit'])->name('roles.edit');
        Route::put('/roles/{id}', [RolesController::class, 'update'])->name('roles.update');
        Route::delete('/roles/{id}', [RolesController::class, 'destroy'])->name('roles.destroy');

        Route::get('/users', [UserController::class, 'index'])->name('user.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('user.create');
        Route::post('users', [UserController::class, 'store'])->name('user.store');
        Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::put('/users/{id}', [UserController::class, 'update'])->name('user.update');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('user.destroy');
});
});
require __DIR__.'/auth.php';
