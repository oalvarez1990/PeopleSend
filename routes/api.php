<?php

use App\Http\Controllers\PeopleSendController;
use App\Http\Controllers\CategorieController;
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

Route::get('/countries', [PeopleSendController::class, 'getCountries']);

//Create route group for peoplesend
Route::group(['prefix' => 'peoplesends'], function () {
    //Route to get all Peoplesend
    Route::get('', [PeopleSendController::class, 'All']);
    //Route to create PeoplesendCreate
    // Route::post('', [PeopleSendController::class, 'PeoplesendCreate']);
    Route::post('', [PeopleSendController::class, 'PeoplesendCreate']);
    //Route to update PeoplesendCreate
    Route::put('', [PeopleSendController::class, 'PeoplesendUpdate']);
    // countries
    
});
//Create route for categorie
Route::group(['prefix' => 'categories'], function () {
    //Route to get all Categories
    Route::get('', [CategorieController::class, 'All']);
    //Route to get id
    Route::get('{id}', [CategorieController::class, 'id']);
    //Route to create Categories
    Route::post('', [CategorieController::class, 'CategorieCreate']);
    //Route to update Categories
    Route::put('{id}', [CategorieController::class, 'CategorieUpdate']);
    //Route to delete Categories
    Route::delete('{id}', [CategorieController::class, 'CategorieDelete']);
});
