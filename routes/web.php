<?php

use App\Http\Controllers\AtecedentController;
use App\Http\Controllers\DossierController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\RendezvousController;
use App\Http\Controllers\TraitementController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::get('/dashboard', function (Request $request) {
    if ((Auth::user()->updated_at == Auth::user()->created_at)) {
        return view('auth.reset-password', ['request' => $request]);
     }
     else
     {
        return view('dashboard');
     }
    
})->middleware(['auth'])->name('dashboard');

Route::post('/resetPassword', [ UserController::class, 'resetPassword'])->name('resetPassword');
 
Route::middleware(['admin'])->group(function () {
    Route::get('/user/list', [ UserController::class, 'getAll'])->name('listUser');
    Route::post('/adduser', [ UserController::class, 'add'])->name('adduser');
    Route::get('/user/update/{id}', [ UserController::class, 'update'])->name('updateUser');
});
 
Route::middleware(['medecinsecretaire'])->group(function () {
    Route::get('/antecedent/list/{id}', [ (AtecedentController::class), 'getAllAntecedent'])->name('listAntecedent');
    Route::post('/Antecedent/add/{id}', [ (AtecedentController::class), 'addAntecedent'])->name('addAntecedent');
    Route::get('/antecedent/delete/{id}', [ (AtecedentController::class), 'deleteAntecedent'])->name('deleteAntecedent');
    
    Route::get('/rendezvous/list/{id}', [ (RendezvousController::class), 'getAllRendezvous'])->name('listRV');
    Route::get('/rendezvous/active/{id}', [ (RendezvousController::class), 'getActiveRV'])->name('activeRV');
    Route::post('/rendezvous/add/{id}', [ (RendezvousController::class), 'addRV'])->name('addRV');
    Route::post('/rendezvous/decaler/{id}', [ (RendezvousController::class), 'decalerRV'])->name('decalerRV');
    
    Route::get('/dossier/actice/{id}', [ (DossierController::class), 'getDossier'])->name('getDossier');
    Route::get('/dossier/all/{id}', [ (DossierController::class), 'getAllDossier'])->name('getAllDossier');
    Route::get('/dossier/select/{id}', [ (DossierController::class), 'getDossierbyId'])->name('getDossierbyId');   
    
    Route::get('/prescription/list/{id}', [ (PrescriptionController::class), 'getActive'])->name('listPrescription');
    Route::get('/ordonance/{id}', [ (PrescriptionController::class), 'getByOrdonance'])->name('getByOrdonance');
    
    Route::get('/ordonance/pdf/{id}', [ (PdfController::class), 'ordonancePDF'])->name('ordonancePDF');
});

Route::middleware(['secretaire'])->group(function () {
    
    Route::get('/patient/list', [ (PatientController::class), 'getAll'])->name('listPatient');
    Route::post('/patient/add', [ (PatientController::class), 'addPatient'])->name('addpatient');

    Route::get('/facture/pdf/{id}', [ (PdfController::class), 'facturePDF'])->name('facturePDF');
});

Route::middleware(['medecin'])->group(function () {
    
    Route::get('/medecin/patient', [ (PatientController::class), 'getAllPatient'])->name('medecinPatient');

    Route::get('/rendezvous/fin/{id}', [ (RendezvousController::class), 'finRV'])->name('finRV');

    Route::get('/traitement/list/{id}', [ (TraitementController::class), 'getActive'])->name('listTraitement');
    Route::post('/traitement/add/{id}', [ (TraitementController::class), 'add'])->name('addTraitement');
    Route::get('/traitement/all/{id}', [ (TraitementController::class), 'getAll'])->name('allTraitement');

    Route::post('/prescription/add/{id}', [ (PrescriptionController::class), 'add'])->name('addPrescription');
    Route::get('/prescription/delete/{id}', [ (PrescriptionController::class), 'delete'])->name('deletePrescription');
});

require __DIR__.'/auth.php';
