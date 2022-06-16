<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\Dashboard\Admin;
use App\http\Controllers\Dashboard\Patients;
use App\http\Controllers\Dashboard\Doctors;
use App\http\Controllers\Dashboard\Specialties;
use App\http\Controllers\Dashboard\Appointments;
use App\http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Dashboard\Departments;
use App\Http\Controllers\Dashboard\Medicines;

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
    return view('welcome');
});
// private route
Route::middleware('auth')->group( function() {
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
    Route::get('/doctors', [Doctors::class, 'index'] )->name('doctor'); 
    //specialties
    Route::get('/specialties', [Specialties::class, 'index'] )->name('specialties');
    Route::get('/specialties/create', [Specialties::class, 'create'] );
    //appointments 
    Route::get('/Appointments', [Appointments::class, 'index'] )->name('appointments');


    //departments 
    Route::get('/departments', [Departments::class, 'index'] )->name('departments');
    Route::get('/departments/create', [Departments::class, 'create'] )->name('departments.create');


    //medicines 
    Route::get('/medicines', [Medicines::class, 'index'] )->name('medicines');
    Route::get('/medicines/create', [Medicines::class, 'create'] )->name('medicines.create');







});
// public routes for login
Route::middleware('guest')->group( function() {
    Route::get('/login', [AdminAuthController::class, 'index'] )->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'] );
});




