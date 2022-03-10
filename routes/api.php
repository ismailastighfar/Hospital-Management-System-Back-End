<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;


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

<<<<<<< HEAD
Route::get('doctor/search' , [DoctorController::class, 'search' ]);
=======
Route::resource('medicines' , MedicineController::class);
>>>>>>> 08f6b84397da84aa69a123bf9e68c976053e0551

Route::get('/medicines/search/{name}', [MedicineController::class, 'search']);

Route::resource('users' , UserController::class);

Route::resource('patients' , PatientController::class);

Route::get('patient/search' , [PatientController::class, 'search' ]);



Route::resource('questions', QuestionController::class);


Route::resource('answers', AnswerController::class);


Route::resource('departments' , DepartmentController::class);

<<<<<<< HEAD

=======
>>>>>>> 08f6b84397da84aa69a123bf9e68c976053e0551
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
