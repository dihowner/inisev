<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\SubscribersController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(PostsController::class)->prefix('post')->group(function () {
    Route::post('create-website-post', 'createWebsitePost');
});

Route::controller(SubscribersController::class)->prefix('website')->group(function () {
    Route::post('subscribe', 'subscribeToWebsite');
});