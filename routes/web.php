<?php

use App\Http\Controllers\PatientsController;
use App\Http\Controllers\InternmentsController;
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

Auth::routes();
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [PatientsController::class, 'index'])->name('patients.index');
    Route::get('/patients/register', [PatientsController::class, 'create'])->name('patients.register');
    Route::post('/patients/register', [App\Http\Controllers\PatientsController::class, 'store'])->name('patients.store');
    Route::get('/patients/{id}', [App\Http\Controllers\PatientsController::class, 'show'])->name('patients.show');
    Route::get('/patients/{id}/edit', [App\Http\Controllers\PatientsController::class, 'edit'])->name('patients.edit');
    Route::patch('/patients/{id}', [App\Http\Controllers\PatientsController::class, 'update'])->name('patients.update');

    Route::get('/internments/historic', [InternmentsController::class, 'index'])->name('patients.historic');
    Route::patch('/internments/{id}', [InternmentsController::class, 'update'])->name('internments.update');
    Route::post('/internment', [InternmentsController::class, 'store'])->name('internments.store');
    Route::post('/phones', [\App\Http\Controllers\PhonesController::class, 'store'])->name('phones.store');
    Route::delete('/phones/{id}', [\App\Http\Controllers\PhonesController::class, 'destroy'])->name('phones.destroy');
    Route::get('/internment/{id}/medicaments', [InternmentsController::class, 'medicaments'])->name('internment.medicaments');
    Route::patch('/applications/{id}', [\App\Http\Controllers\MedicamentApplicationsController::class, 'update'])->name('application.update');
    Route::post('/application', [\App\Http\Controllers\MedicamentApplicationsController::class, 'store'])->name('application.store');


    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

