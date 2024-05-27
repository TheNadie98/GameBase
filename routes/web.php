<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $posts = [];
    if (auth()->check()) {
        $posts = auth()->user()->posts()->latest()->get();
    }
    return view('home', ['posts' => $posts]);
});

Route::post('/create-post', [PostController::class, 'createPost']);
Route::get('/edit-post/{post}', [PostController::class, 'showEditScreen']);
Route::put('/edit-post/{post}', [PostController::class, 'actuallyUpdatePost']);
Route::delete('/delete-post/{post}', [PostController::class, 'deletePost']);

// Ruta para la búsqueda de usuarios
Route::get('/users/search', [UserController::class, 'search'])->name('users.search');

// Ruta para buscar usuarios y mostrar sus posts
Route::get('/user-searchpost', [PostController::class, 'searchUserPosts'])->name('user.searchposts');
Route::get('/users/{user}/posts', [PostController::class, 'showUserPosts'])->name('users.posts');

// Rutas relacionadas con el controlador de usuarios
Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'login']);

// Nuevas rutas para las vistas de login y registro
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');
