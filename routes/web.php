<?php

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

require __DIR__.'/auth.php';
