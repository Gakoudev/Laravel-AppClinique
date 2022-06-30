<?php

use App\Http\Controllers\AtecedentController;
use App\Http\Controllers\DossierController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\RendezvousController;
use App\Http\Controllers\TraitementController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::controller(UserController::class)->group(function(){

    Route::get('/user/list', [ 'as' => 'listUser', 'uses' => 'getAll']);
    Route::post('/adduser', [ 'as' => 'adduser', 'uses' => 'add']);
    Route::get('/user/update/{id}', [ 'as' => 'updateUser', 'uses' => 'update']);
});

Route::controller(PatientController::class)->group(function(){

    Route::get('/medecin/patient', [ 'as' => 'medecinPatient', 'uses' => 'getAllPatient']);
    Route::get('/patient/list', [ 'as' => 'listPatient', 'uses' => 'getAll']);
    Route::post('/addpatient', [ 'as' => 'addpatient', 'uses' => 'addPatient']);
});

Route::controller(AtecedentController::class)->group(function(){

    Route::get('/antecedent/list/{id}', [ 'as' => 'listAntecedent', 'uses' => 'getAllAntecedent']);
    Route::post('/addAntecedent/{id}', [ 'as' => 'addAntecedent', 'uses' => 'addAntecedent']);
    Route::get('/antecedent/delete/{id}', [ 'as' => 'deleteAntecedent', 'uses' => 'deleteAntecedent']);
});

Route::controller(RendezvousController::class)->group(function(){

    Route::get('/rendezvous/list/{id}', [ 'as' => 'listRV', 'uses' => 'getAllRendezvous']);
    Route::get('/rendezvous/active/{id}', [ 'as' => 'activeRV', 'uses' => 'getActiveRV']);
    Route::post('/addRV/{id}', [ 'as' => 'addRV', 'uses' => 'addRV']);
    Route::post('/rendezvous/{id}', [ 'as' => 'updateRV', 'uses' => 'updateRV']);
    Route::get('/rendezvous/decaler/{id}', [ 'as' => 'decalerRV', 'uses' => 'decalerRV']);
    Route::get('/rendezvous/fin/{id}', [ 'as' => 'finRV', 'uses' => 'finRV']);
});

Route::controller(TraitementController::class)->group(function(){

    Route::get('/traitement/list/{id}', [ 'as' => 'listTraitement', 'uses' => 'getActive']);
    Route::post('/addTraitement/{id}', [ 'as' => 'addTraitement', 'uses' => 'add']);
    Route::get('/traitement/All/{id}', [ 'as' => 'allTraitement', 'uses' => 'getAll']);
});

Route::controller(DossierController::class)->group(function(){

    Route::get('/dossier/actice/{id}', [ 'as' => 'getDossier', 'uses' => 'getDossier']);
    Route::get('/dossier/all/{id}', [ 'as' => 'getAllDossier', 'uses' => 'getAllDossier']);
    Route::get('/dossier/select/{id}', [ 'as' => 'getDossierbyId', 'uses' => 'getDossierbyId']);
});

Route::controller(PrescriptionController::class)->group(function(){

    Route::get('/prescription/list/{id}', [ 'as' => 'listPrescription', 'uses' => 'getActive']);
    Route::post('/Prescription/add/{id}', [ 'as' => 'addPrescription', 'uses' => 'add']);
    Route::get('/ordonance/{id}', [ 'as' => 'getByOrdonance', 'uses' => 'getByOrdonance']);
    Route::get('/prescription/delete/{id}', [ 'as' => 'deletePrescription', 'uses' => 'delete']);
});

require __DIR__.'/auth.php';
