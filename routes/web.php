<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\ListOperationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OperationController;
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

Route::redirect('/', '/login');

Route::get('/login', function () {
    return view('auth/login');
});

Route::post('/login', [LoginController::class, 'authenticate']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth.basic')->name('dashboard');

Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/list-operation', [ListOperationController::class, 'index'])->middleware('auth.basic')->name('list-operation');

Route::post('/list-operation', [ListOperationController::class, 'create'])->middleware('auth.basic');

Route::post('/list-operation/update', [ListOperationController::class, 'update']);

Route::post('/list-operation/delete', [ListOperationController::class, 'delete']);

Route::post('/operation/delete', [DashboardController::class, 'deleteOperation']);

Route::get('/operation/{id?}', [OperationController::class, 'index'])->middleware('auth.basic');

Route::post('/operation/{id?}', [OperationController::class, 'save']);


