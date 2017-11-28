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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

/**
 * Set the default documentation version...
 */
define('DEFAULT_API_VERSION', 'v1');

/*
 * Api routes.
 */
Route::group(['namespace' => 'Api', 'prefix' => DEFAULT_API_VERSION . '/'], function () {
    Route::get('/sub-category/{parent_id}', 'ApiController@getSubCategoryByCategory');
});