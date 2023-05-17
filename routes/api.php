<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AuthenticationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('/login', AuthenticationController::class . '@login');

Route::get('/posts', PostController::class . '@index');
Route::get('/posts/{id}', PostController::class . '@show');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/posts', PostController::class . '@store');
    Route::patch('/posts/{id}', PostController::class . '@update')->middleware('pemilik-postingan');
    Route::delete('/posts/{id}', PostController::class . '@destroy')->middleware('pemilik-postingan');

    Route::post('/comment', CommentController::class . '@store');
    Route::patch('/comment/{id}', CommentController::class . '@update')->middleware('pemilik-commentar');
    Route::delete('/comment/{id}', CommentController::class . '@destroy')->middleware('pemilik-commentar');


    Route::get('/logout', AuthenticationController::class . '@logout');
    Route::get('/me', AuthenticationController::class . '@me');
});
