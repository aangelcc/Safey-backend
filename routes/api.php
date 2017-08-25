<?php

use Illuminate\Http\Request;
use App\User;

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

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::get('/ping', function(Request $request) {
    return $request->all();
});

Route::get('/hashed', function(Request $request) {
    $plainPassword = $request->input('password');
    return $plainPassword .' -> '. Hash::make($plainPassword) .' --- '. $request->bearerToken();
});

Route::post('auth/login', 'UserController@login');

Route::post('auth/register', 'UserController@register');

// All routes inside this group will be applied the jwt.auth middleware
Route::group(['middleware' => 'jwt.auth'], function () {
    Route::resource('/users', 'UserController');
});

Route::resource('/comments', 'CommentController');
