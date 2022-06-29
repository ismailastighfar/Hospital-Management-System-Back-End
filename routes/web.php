<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\Dashboard\Admin;
use App\http\Controllers\Dashboard\Patients;
use App\http\Controllers\Dashboard\Doctors;
use App\http\Controllers\Dashboard\Specialties;
use App\http\Controllers\Dashboard\Appointments;
use App\http\Controllers\Admin\AdminAuthController;
use App\http\Controllers\Doctor\DoctorAuthController;
use App\Http\Controllers\Dashboard\Departments;
use App\Http\Controllers\Dashboard\Medicines;
use App\Http\Controllers\dashboard\Questions;
use App\Http\Controllers\dashboard\Doctor\scheduleController;
use Carbon\Carbon;
use App\Models\Appointment;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('accuiel');
});
// private route
Route::middleware('auth')->group( function() {

    Route::get('/doctor/index', function() {
        $today = Carbon::now();
        $todayFormated = Carbon::createFromDate($today->year.'-'.$today->month.'-'.$today->day )->format('Y-m-d');
        $doctor = Auth::user()->doctor;
        $appointment = Appointment::where('doctor_id', $doctor->id)->where('date', $todayFormated )->where('status', '<>' , 0)->orderBy('time', 'asc')->get();
        return view('DoctorView.index', ['doctor' => $doctor, 'appointment' => $appointment ]);
    });


    Route::get('/doctor/schedule/{nbweek?}', [scheduleController::class, 'index']);


    Route::get('/doctor/questions/{opt?}', [scheduleController::class, 'questions']);
    Route::get('/doctor/answer/{id}', [scheduleController::class, 'answer']);
    Route::get('/doctor/answers/{id}', [scheduleController::class, 'answers']);
    Route::get('/doctor/prescreption/{id}', [scheduleController::class, 'prescreption']);
    //logout 
    Route::get('/logout', [AdminAuthController::class, 'logout']);
    //index page
    Route::get('/index', [Admin::class, 'index'])->name('index');
    // patients
    Route::get('/patients', [Patients::class, 'index'] )->name('patients');
    Route::get('/patients/profile/{patient}', [Patients::class, 'profile'] )->name('patient.profile'); 
    // doctors
    Route::get('/doctors/profile/{doctor}/{nbweek?}', [Doctors::class, 'profile'] )->name('doctor.profile'); 
    Route::get('/doctors/create', [Doctors::class, 'create'] )->name('doctor.profile'); 
    Route::get('/doctors/edit/{id}', [Doctors::class, 'edit'] ); 
    Route::put('/doctors/{doctor}', [Doctors::class, 'update'] ); 
    Route::get('/doctors/avai/{id}', [Doctors::class, 'ChangeAvai'] ); 
    Route::get('/doctors', [Doctors::class, 'index'] )->name('doctor'); 
    //specialties
    Route::get('/specialties', [Specialties::class, 'index'] )->name('specialties');
    Route::get('/specialties/create', [Specialties::class, 'create'] )->name('specialty.create');


    //appointments 
    Route::get('/Appointments', [Appointments::class, 'index'] )->name('appointments');
    Route::get('/Appointments/edit/{id}', [Appointments::class, 'edit'] );
    Route::put('/Appointments/edit/{id}', [Appointments::class, 'update'] );


    //departments 
    Route::get('/departments', [Departments::class, 'index'] )->name('departments');
    Route::get('/departments/create', [Departments::class, 'create'] )->name('departments.create');
    Route::get('/departments/edit/{id}', [Departments::class, 'edit'] )->name('departments.edit');
    Route::put('/departments/edit/{id}', [Departments::class, 'update'] );



    //medicines 
    Route::get('/medicines', [Medicines::class, 'index'] )->name('medicines');
    Route::get('/medicines/create', [Medicines::class, 'create'] )->name('medicines.create');
    Route::get('/medicines/edit/{id}', [Medicines::class, 'edit'] )->name('medicines.edit');
    Route::put('/medicines/edit/{id}', [Medicines::class, 'update'] );

    // questions
    Route::get('/questions', [Questions::class, 'index'] )->name('questions');
    Route::get('/answers', [Questions::class, 'index2'] )->name('answers');







});
// public routes for login
Route::middleware('guest')->group( function() {
    Route::get('/', function () {
        return view('accuiel');
    });
    Route::get('/login', [AdminAuthController::class, 'index'] )->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'] );
    Route::get('/doctor/login', [DoctorAuthController::class, 'index'] );
    Route::post('/doctor/login', [DoctorAuthController::class, 'login'] );
});




