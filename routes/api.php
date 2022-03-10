<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\AuthController;
use App\Models\Department;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::resource('doctors' , DoctorController::class);

Route::get('doctor/search' , [DoctorController::class, 'search' ]);

Route::get('/medicines/search/{name}', [MedicineController::class, 'search']);

Route::resource('users' , UserController::class);


Route::get('patient/search' , [PatientController::class, 'search' ]);



Route::resource('questions', QuestionController::class);


Route::resource('answers', AnswerController::class);



Route::post('/login', [AuthController::class, 'login']);

Route::get('/logout', [AuthController::class, 'logout']);

Route::group(['middleware' => ['auth:sanctum', 'isPatient']],   function () {

    Route::resource('patients' , PatientController::class);

    Route::get('/logout', [AuthController::class, 'logout'])->withoutMiddleware('isPatient');

});
Route::group(['middleware' => ['auth:sanctum', 'isDoctor']],   function () {

    Route::resource('doctors' , DoctorController::class);

    Route::get('/logout', [AuthController::class, 'logout'])->withoutMiddleware('isDoctor');

});
Route::group(['middleware' => ['auth:sanctum', 'isAdmin']],   function () {

    Route::resource('departments' , DepartmentController::class);
    
    Route::get('/logout', [AuthController::class, 'logout'])->withoutMiddleware('isAdmin');

});
