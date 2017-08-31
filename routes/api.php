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
Route::resource('/users', 'UserController', ['only' => [ 'index','show','update','destroy']]);

Route::resource('/comments', 'CommentController', ['only' => [ 'index', 'store','show','update','destroy']]);

Route::resource('/orders', 'OrderController', ['only' => [ 'index', 'store','show','update','destroy']]);

Route::resource('/products', 'ProductController', ['only' => [ 'index', 'store','show','update','destroy']]);

Route::resource('/stores', 'StoreController', ['only' => [ 'index', 'store','show','update','destroy']]);

Route::get('/search','SearchProductController');

