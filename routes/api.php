<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Doctor\DoctorAuthController;
use App\Http\Controllers\Patient\PatientAuthController;
use App\Http\Controllers\Admin\AdminAuthController;
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


Route::prefix('doctor')->group( function(){
    Route::post('login', [DoctorAuthController::class, 'login']);
    Route::get('logout', [DoctorAuthController::class, 'logout'])->middleware('auth:sanctum');
});

Route::prefix('patient')->group(function(){
    Route::post('login', [PatientAuthController::class, 'login']);
    Route::get('logout', [PatientAuthController::class, 'logout'])->middleware('auth:sanctum');

});
Route::prefix('admin')->group(function(){
    Route::post('login', [AdminAuthController::class, 'login']);
    Route::get('logout', [AdminAuthController::class, 'logout'])->middleware('auth:sanctum');

});
Route::middleware(['auth:sanctum'])->group( function() {


    // appointment routers
    Route::resource('appointments' , AppointmentController::class);
    Route::resource('prescriptions' , PrescriptionController::class);


    Route::get('/appointments/accepte/{appointment}' , [AppointmentController::class , 'updateStatusToAccepted'] );
    Route::get('/appointments/complete/{appointment}' , [AppointmentController::class , 'updateStatusToCompleted'] );

    // user routers

    Route::get('/users', [UserController::class, 'index'])->middleware('isAdmin');
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->middleware('isAdmin');

    // doctor routers

    Route::put('/doctors/{id}', [DoctorController::class, 'update'])->middleware('isAdmin');
    Route::post('/doctors', [DoctorController::class, 'store'])->middleware('isAdmin');

    // patient routers

    Route::get('/patients', [PatientController::class, 'index'])->middleware('isAdmin');
    Route::get('/patients/{patient}', [PatientController::class, 'show']);
    Route::post('/patients', [PatientController::class, 'store'])->middleware('isPatient');
    Route::put('/patients', [PatientController::class, 'update'])->middleware('isPatient');
    Route::get('/patient/search' , [PatientController::class, 'search' ]);

    // department routers

    Route::post('/departments', [DepartmentController::class, 'store'])->middleware('isAdmin');
    Route::put('/departments', [DepartmentController::class, 'update'])->middleware('isAdmin');
    Route::delete('/departments', [DepartmentController::class, 'delete'])->middleware('isAdmin');

    // question routers

    Route::post('/questions', [QuestionController::class, 'store'])->middleware('isPatient');
    Route::put('/questions/{question}', [QuestionController::class, 'update'])->middleware('isPatient');
    Route::delete('/questions/{question}', [QuestionController::class, 'destroy']);
    Route::get('/questions/patient/{id}',[QuestionController::class,'patientQuestions']);

    // answers routers

    Route::post('/answers', [AnswerController::class, 'store'])->middleware('isDoctor');
    Route::put('/answers/{answer}', [AnswerController::class, 'update'])->middleware('isDoctor');
    Route::delete('/answers/{answer}', [AnswerController::class, 'destroy'])->middleware('isDoctor');

    Route::get('/answers/doctor/{id}',[AnswerController::class, 'doctorAnswer'])->middleware('isDoctor');

    // medicines routers

    Route::post('/medicines', [MedicineController::class, 'store'])->middleware('isAdmin');
    Route::put('/medicines/{medicines}', [MedicineController::class, 'update'])->middleware('isAdmin');
    Route::delete('/medicines/{medicines}', [MedicineController::class, 'destroy'])->middleware('isAdmin');

});

// Public Routers

// User Route 

Route::post('/users', [UserController::class, 'store']);


// Doctor Route

Route::get('/doctors', [DoctorController::class, 'index']);
Route::get('/doctors/{doctor}', [DoctorController::class, 'show']);
Route::get('/doctor/search' , [DoctorController::class, 'search']);


// Departement Routes

Route::get('/departments', [DepartmentController::class, 'index']);
Route::get('/departments/{department}', [DepartmentController::class, 'show']);

// Quetions Routes

Route::get('/questions', [QuestionController::class, 'index']);
Route::get('/questions/{question}', [QuestionController::class, 'show']);

// Answers Routes

Route::get('/answers', [AnswerController::class, 'index']);
Route::get('/answers/{answer}', [AnswerController::class, 'show']);
Route::get('/answers/question/{id}',[AnswerController::class, 'questionAnswers']);

// Medicines Routes 

Route::get('/medicines', [MedicineController::class, 'index']);
Route::get('/medicines/{medicine}', [MedicineController::class, 'show']);
Route::get('/medicines/search/{name}', [MedicineController::class, 'search']);



