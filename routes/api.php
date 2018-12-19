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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('post/{id}', function ($id) {
    try {
        return new \App\Http\Resources\Post(\App\Post::findOrFail($id));
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return response(['message'=>'Not Found'], 404);
    }
});
