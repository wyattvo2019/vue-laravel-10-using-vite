<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\API\AuthController;
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
Route::apiResource('student', StudentController::class);
Route::resource('products', ProductController::class);
//API route để đăng ký
Route::post('/login', [AuthController::class, 'register']);
//API route để đăng nhập
Route::post('/login', [AuthController::class, 'login']);
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function(Request $request) {
        return auth()->user();
});
// API route thoát
Route::post('/logout', [AuthController::class, 'logout']);
});
//API route để đăng ký
Route::post('/dangky', [AuthController::class, 'register']);
//API route để đăng nhập
Route::post('/dangnhap', [AuthController::class, 'login']);
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function(Request $request) {
        return auth()->user();
    });
// API route thoát
Route::post('/logout', [AuthController::class, 'logout']);
});
Route::post('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');
Route::resource('teachers', TeacherController::class);




