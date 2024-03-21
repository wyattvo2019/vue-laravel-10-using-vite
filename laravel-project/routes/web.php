<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;

Route::get('/', function () {
    return view('welcome');
});
Route::apiResource('/student', StudentController::class);
Route::apiResource('/teacher', TeacherController::class);

