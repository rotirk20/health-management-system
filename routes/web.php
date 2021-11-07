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

Route::get('/', 'App\Http\Controllers\HomeController@search')->name('search');
Route::post('/create-appointment', 'App\Http\Controllers\HomeController@store_appointment')->name('create.appointment');

//Profile & Users Admin 
Route::get('/profile', 'App\Http\Controllers\UserController@profile')->name('profile')->middleware('auth');
Route::get('/profile/change-password', 'App\Http\Controllers\ChangePasswordController@index')->middleware('auth');
Route::post('/profile/change-password', 'App\Http\Controllers\ChangePasswordController@store')->name('change.password')->middleware('auth');

Route::group(['prefix' => 'settings', 'middleware' => 'role:Admin'], function () {
    Route::get('/users', 'App\Http\Controllers\UserController@index')->name('users');
    Route::get('/users/{id}/edit', 'App\Http\Controllers\UserController@edit');
    Route::get('/users/create', 'App\Http\Controllers\UserController@create');
    Route::post('/users/create', 'App\Http\Controllers\UserController@store');
    Route::get('/user/{id}/delete', 'App\Http\Controllers\UserController@destroy');
    Route::put('/users/update/{id}', 'App\Http\Controllers\UserController@update')->name('users.update');

    //Roles
    Route::get('/roles/create', 'App\Http\Controllers\RoleController@create')->name('roles.create');
    Route::post('/roles/create', 'App\Http\Controllers\RoleController@store')->name('roles.store');
    Route::get('/roles', 'App\Http\Controllers\RoleController@index')->name('roles');
    Route::get('/roles/{id}', 'App\Http\Controllers\RoleController@show')->name('roles.show');
    Route::get('/roles/{id}/edit', 'App\Http\Controllers\RoleController@edit')->name('roles.edit');
    Route::put('/roles/update/{id}', 'App\Http\Controllers\RoleController@update')->name('roles.update');
    Route::get('/roles/{id}/delete', 'App\Http\Controllers\RoleController@destroy')->name('roles.destroy');
});

//Settings

Route::get('/settings', 'App\Http\Controllers\SettingsController@index')->name('settings')->middleware(['role:Admin']);
Route::post('/settings', 'App\Http\Controllers\SettingsController@saveSettings')->name('settings.save')->middleware(['role:Admin']);

//Patients
Route::get('/patients', 'App\Http\Controllers\PatientController@index')->name('patients')->middleware('auth');
Route::get('/patient/view/{id}', 'App\Http\Controllers\PatientController@show')->name('patient.view')->middleware('auth');
Route::get('/patient/create', 'App\Http\Controllers\PatientController@create')->name('patient/create')->middleware('auth');
Route::post('/patient/create', 'App\Http\Controllers\PatientController@store')->middleware('auth');
Route::get('/patient/{id}/edit', 'App\Http\Controllers\PatientController@edit')->name('patient.edit')->middleware('auth');
Route::put('/patient/update/{id}', 'App\Http\Controllers\PatientController@update')->middleware('auth');
Route::get('/patient/{id}/delete', 'App\Http\Controllers\PatientController@destroy')->middleware('auth');

//Doctors
Route::get('/doctors', 'App\Http\Controllers\DoctorController@index')->name('doctors')->middleware('auth');
Route::get('/doctor/create', 'App\Http\Controllers\DoctorController@create')->name('doctor/create')->middleware('auth');
Route::post('/doctor/create', 'App\Http\Controllers\DoctorController@store')->middleware('auth');
Route::post('/doctor/view/{id}', 'App\Http\Controllers\DoctorController@show')->middleware('auth');

//Verify appointment
Route::get('/appointments/verify/{code}', 'App\Http\Controllers\HomeController@verify');
Route::post('/appointments/verify', 'App\Http\Controllers\HomeController@verifyAppointment');

//Appointments
Route::get('/appointments', 'App\Http\Controllers\AppointmentController@index')->name('appointments')->middleware('auth');
Route::get('/appointment/create', 'App\Http\Controllers\AppointmentController@create')->name('appointment/create')->middleware('auth');
Route::post('/date_check', 'App\Http\Controllers\AppointmentController@checkDate');
Route::get('/appointments/search', 'App\Http\Controllers\AppointmentController@searchAppointment')->middleware('auth');
Route::get('/appointment/view/{id}', 'App\Http\Controllers\AppointmentController@show')->middleware('auth');
Route::post('/appointment/create', 'App\Http\Controllers\AppointmentController@store')->middleware('auth');
Route::get('/appointment/{id}/edit', 'App\Http\Controllers\AppointmentController@edit')->name('appointment.edit')->middleware('auth');
Route::put('/appointment/update/{id}', 'App\Http\Controllers\AppointmentController@update')->middleware('auth');
Route::get('/appointment/{id}/delete', 'App\Http\Controllers\AppointmentController@destroy')->middleware('auth');

Auth::routes();

Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard')->middleware('auth');;
Route::post('/charts-data', 'App\Http\Controllers\DashboardController@data')->middleware('auth');;
