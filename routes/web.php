<?php

use App\Http\Controllers\SubscribedUserNotifyController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::controller(SubscribedUserNotifyController::class)->prefix('subscribe')->group(function () {
    Route::get('notify', 'notifyUnnotifiedUser');
});