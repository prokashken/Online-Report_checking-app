<?php

use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\MedicalController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\OnlyAdmin;
use App\Http\Middleware\OnlyCommon;
use App\Http\Middleware\OnlyDoctor;
use App\Http\Middleware\OnlyUser;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });


Route::middleware('auth',OnlyUser::class)->group(function () {
    Route::get('/export-patients', [ListController::class, 'exportPatients']);
    Route::post('/upload-patients', [ListController::class, 'uploadPatients']);
    Route::post('/upload-images', [ListController::class, 'uploadDicom']);

    Route::get('edit-userprofile/{id}', [ListController::class, 'editAdmin']);
    Route::post('update-userprofile/{id}', [ListController::class, 'updateUserProfile']);


    Route::resource('patients', PatientController::class);
    Route::post('/delete-all', [ListController::class, 'delete']);
});

Route::middleware('auth',OnlyDoctor::class)->group(function () {
    Route::get('medical-patient-list/{id}',[ListController::class,'medicalPatientList']);
    Route::get('/doctor-home',[ListController::class,'doctorHome']);
    Route::get('next-medical/{id}', [ListController::class, 'nextMedical']);

    Route::get('edit-doctorprofile/{id}', [ListController::class, 'editAdmin']);
    Route::post('update-doctorprofile/{id}', [ListController::class, 'updateUserProfile']);
});

Route::middleware('auth',OnlyCommon::class)->group(function () {
    Route::get('editpatient/{id}', [ListController::class, 'edit']);
    Route::post('patient/{id}', [ListController::class, 'update']);
    Route::get('pati/list', [ListController::class, 'patientList'])->name('patient.list');
});

Route::middleware('auth',OnlyAdmin::class)->group(function () {
// Admin Start

    Route::get('admin/dashboard', [ListController::class, 'index']);
    Route::get('medi/list', [ListController::class, 'medicalList'])->name('medical.list');
    Route::get('usr/list', [ListController::class, 'userlist'])->name('user.list');
    Route::get('doc/list', [ListController::class, 'doctorlList'])->name('doctor.list');

    Route::resource('users', UserController::class);
    Route::resource('medicals', MedicalController::class);
    Route::resource('doctors', DoctorController::class);
    // Admin End
    Route::get('edit-adminprofile/{id}', [ListController::class, 'editAdmin']);
    Route::post('update-adminprofile/{id}', [ListController::class, 'updateUserProfile']);
    // update Admin profile
});




require __DIR__.'/auth.php';
