<?php

use App\Http\Controllers\Auth\UserController;
use Illuminate\Support\Facades\Route;
use PharIo\Manifest\AuthorCollection;

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
//
//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
//for test
Route::get('/mail',function (){
    return view('mail');
});

Route::group(['middleware'=>['api','password','lang']],static function(){
    Route::group(['prefix'=>'user'],static function(){
        Route::post('register',[UserController::class,'register']);
        Route::post('login',[UserController::class,'login']);

        Route::group(['middleware'=>''],static function(){
            Route::post('send_code',[AuthorCollection::class,'sendCode']);
        });

    });
});
