<?php

declare(strict_types=1);

use App\Http\Controllers\Post\CreatePostsEndpoint;
use App\Http\Controllers\Post\DeletePostsEndpoint;
use App\Http\Controllers\Post\GetAllPostsEndpoint;
use App\Http\Controllers\Post\UpdatePostsEndpoint;
use App\Http\Controllers\User\GetAllUsersEndpoint;
use App\Http\Controllers\User\LoginEndpoint;
use App\Http\Controllers\User\RegistrationEndpoint;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', LoginEndpoint::class);
Route::post('/register', RegistrationEndpoint::class);
Route::get('/users', GetAllUsersEndpoint::class);

Route::get('/posts', GetAllPostsEndpoint::class);
Route::post('/posts', CreatePostsEndpoint::class)->can('create', Post::class);
Route::put('/posts/{post}', UpdatePostsEndpoint::class)->can('update', 'post');
Route::delete('/posts/{post}', DeletePostsEndpoint::class)->can('update', 'post');
