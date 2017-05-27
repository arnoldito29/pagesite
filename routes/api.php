<?php

use Illuminate\Http\Request;

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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::group(['prefix' => 'v1', 'middleware' => ['api']], function () {
    
    Route::get('/user/get/{id}', 'Apiv1Controller@getUser');
    Route::post('/user/login', 'Apiv1Controller@userLogin');
    Route::post('/user/register', 'Apiv1Controller@userRegister');
    Route::post('/user/device/register', 'Apiv1Controller@userDeviceRegister');
    Route::post('/user/device/unregister', 'Apiv1Controller@userDeviceUnregister');
    
    Route::get('/ride/search', 'Apiv1Controller@rideSearch');
    Route::post('/ride/request', 'Apiv1Controller@rideRequest');
    Route::get('/ride/get', 'Apiv1Controller@getRide');
    Route::get('/ride/bookseat', 'Apiv1Controller@rideBookSeat');
});
