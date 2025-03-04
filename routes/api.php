<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\NewUsersController;
use App\Http\Controllers\SlideController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(NewUsersController::class)->group(function () {
    Route::get('users','index');
    Route::get('users/{id}','show');
    Route::post('store-users','store');
    Route::get('edit-users/{id}', 'edit'); 
    Route::put('update-users/{id}', 'update'); 
    Route::delete('delete-users/{id}','destroy');
});

Route::controller(ItemController::class)->group(function () {
    Route::get('items', 'index');
    Route::get('items/{id}', 'show');
    Route::post('store-items', 'store');
    Route::get('edit-items/{id}','edit');
    Route::put('update-items/{id}', 'update');
    Route::delete('delete-items/{id}', 'destroy');
});

Route::controller(SlideController::class)->group(function () {
    Route::get('slides', 'index');
    Route::get('slides/{id}', 'show');
    Route::post('store-slides', 'store');
    Route::get('edit-slides/{id}','edit');
    Route::put('update-slides/{id}', 'update');
    Route::delete('delete-slides/{id}', 'destroy');
});


Route::controller(ContactController::class)->group(function () {
    Route::get('contacts', 'index'); 
    Route::get('contacts/{id}', 'show'); 
    Route::post('store-contacts', 'store'); 
    Route::put('update-contacts/{id}', 'update'); 
    Route::delete('delete-contacts/{id}', 'destroy');
});

