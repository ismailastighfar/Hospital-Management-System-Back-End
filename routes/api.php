<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PrescriptionController;

use App\Http\Middleware\isAdmin;
use App\Http\Middleware\isPatient;
use App\Models\Appointment;
use GuzzleHttp\Middleware;
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

// Private routers 

Route::middleware(['auth:sanctum'])->group( function() {

    Route::resource('appointments' , AppointmentController::class);
    Route::resource('prescriptions' , PrescriptionController::class);


    Route::get('/appointments/accepte/{appointment}' , [AppointmentController::class , 'updateStatusToAccepted'] );
    Route::get('/appointments/complete/{appointment}' , [AppointmentController::class , 'updateStatusToCompleted'] );


    Route::get('/users', [UserController::class, 'index'])->middleware('isAdmin');
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->middleware('isAdmin');

    Route::put('/doctors/{id}', [DoctorController::class, 'update'])->middleware('isAdmin');
    Route::post('/doctors', [DoctorController::class, 'store'])->middleware('isAdmin');

    Route::get('/patients', [PatientController::class, 'index']);
    Route::get('/patients/{patient}', [PatientController::class, 'show']);
    Route::post('/patients', [PatientController::class, 'store'])->middleware('isPatient');
    Route::put('/patients', [PatientController::class, 'update'])->middleware('isPatient');

    Route::post('/departments', [DepartmentController::class, 'store'])->middleware('isAdmin');
    Route::put('/departments', [DepartmentController::class, 'update'])->middleware('isAdmin');
    Route::delete('/departments', [DepartmentController::class, 'delete'])->middleware('isAdmin');

    Route::post('/questions', [QuestionController::class, 'store'])->middleware('isPatient');
    Route::put('/questions', [QuestionController::class, 'update'])->middleware('isPatient');
    Route::delete('/questions', [QuestionController::class, 'delete']);

    Route::post('/answers', [AnswerController::class, 'store'])->middleware('isDoctor');
    Route::put('/answers', [AnswerController::class, 'update'])->middleware('isDoctor');
    Route::delete('/answers', [AnswerController::class, 'delete'])->middleware('isDoctor');

    Route::post('/medicines', [MedicineController::class, 'store'])->middleware('isAdmin');
    Route::put('/medicines', [MedicineController::class, 'update'])->middleware('isAdmin');
    Route::delete('/medicines', [MedicineController::class, 'delete'])->middleware('isAdmin');

});

// User Route 

Route::post('/users', [UserController::class, 'store']);


// Doctor Route

Route::get('/doctors', [DoctorController::class, 'index']);
Route::get('/doctors/{doctor}', [DoctorController::class, 'show']);
Route::get('/doctor/search' , [DoctorController::class, 'search']);

// Patient Route

Route::get('/patient/search' , [PatientController::class, 'search' ]);


// Departement Routes

Route::get('/departments', [DepartmentController::class, 'index']);
Route::get('/departments/{department}', [DepartmentController::class, 'show']);

// Quetions Routes

Route::get('/questions', [QuestionController::class, 'index'])->middleware('auth:sanctum');
Route::get('/questions/{question}', [QuestionController::class, 'show'])->middleware('auth:sanctum');

// Answers Routes

Route::get('/answers', [AnswerController::class, 'index']);
Route::get('/answers/{answer}', [AnswerController::class, 'show']);


// Medicines Routes 

Route::get('/medicines', [MedicineController::class, 'index']);
Route::get('/medicines/{medicine}', [MedicineController::class, 'show']);
Route::get('/medicines/search/{name}', [MedicineController::class, 'search']);

// Auth Routes 

Route::post('/login', [AuthController::class, 'login']);

Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');


