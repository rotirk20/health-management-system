<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/', 'App\Http\Controllers\AppointmentController@search')->name('search');

Route::get('/profile', 'App\Http\Controllers\UserController@profile')->name('profile')->middleware('auth');
Route::get('/profile/change-password', 'App\Http\Controllers\ChangePasswordController@index')->middleware('auth');
Route::post('/profile/change-password', 'App\Http\Controllers\ChangePasswordController@store')->name('change.password')->middleware('auth');;
Route::get('/users', 'App\Http\Controllers\UserController@index')->name('users')->middleware('auth');
Route::get('user/{id}/delete', 'App\Http\Controllers\UserController@destroy')->middleware('auth');

//Patients
Route::get('/patients', 'App\Http\Controllers\PatientController@index')->name('patients')->middleware('auth');
Route::get('/patient/view/{id}', 'App\Http\Controllers\PatientController@show')->middleware('auth');
Route::get('/patient/create', 'App\Http\Controllers\PatientController@create')->name('patient/create')->middleware('auth');
Route::post('/patient/create', 'App\Http\Controllers\PatientController@store')->middleware('auth');
Route::get('/patient/{id}/edit', 'App\Http\Controllers\PatientController@edit')->middleware('auth');
Route::put('/patient/update/{id}', 'App\Http\Controllers\PatientController@update')->middleware('auth');
Route::get('/patient/{id}/delete', 'App\Http\Controllers\PatientController@destroy')->middleware('auth');

//Doctors
Route::get('/doctors', 'App\Http\Controllers\DoctorController@index')->name('doctors')->middleware('auth');
Route::get('/doctor/create', 'App\Http\Controllers\DoctorController@create')->name('doctor/create')->middleware('auth');
Route::post('/doctor/create', 'App\Http\Controllers\DoctorController@store')->middleware('auth');

//Appointments
Route::get('/appointments', 'App\Http\Controllers\AppointmentController@index')->name('appointments')->middleware('auth');
Route::get('/appointment/create', 'App\Http\Controllers\AppointmentController@create')->name('appointment/create')->middleware('auth');
Route::post('/date_check', 'App\Http\Controllers\AppointmentController@checkDate')->middleware('auth');
Route::get('/appointments/search', 'App\Http\Controllers\AppointmentController@searchAppointment')->middleware('auth');
Route::get('/appointment/view/{id}', 'App\Http\Controllers\AppointmentController@show')->middleware('auth');
Route::post('/appointment/create', 'App\Http\Controllers\AppointmentController@store')->middleware('auth');
Route::get('/appointment/{id}/edit', 'App\Http\Controllers\AppointmentController@edit')->middleware('auth');
Route::put('/appointment/update/{id}', 'App\Http\Controllers\AppointmentController@update')->middleware('auth');
Route::get('/appointment/{id}/delete', 'App\Http\Controllers\AppointmentController@destroy')->middleware('auth');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index',])->name('home');
