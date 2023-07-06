<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SMController;
use App\Http\Controllers\SKController;
use App\Http\Controllers\UserController;

use App\Models\User;


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

//Controller untuk User
Route::post('/login',[AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);



Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function (Request $request) {
        return auth()->user();
    });

    //Controller Surat Masuk
    Route::get('/sm',[SMController::class, 'index']);   
    Route::get('/sm/{id_sm}',[SMController::class, 'getData']);
    Route::post('/sm/save',[SMController::class, 'save']);
    Route::get('/sm/read/{id_sm}',[SMController::class, 'updateRead']);

    //controller surat keluar
    Route::get('/sk',[SKController::class, 'index']);   

    Route::post("/buatsurat",[SKController::class, 'create'] );
    Route::get("/users",[UserController::class, 'getUsers']);
});


