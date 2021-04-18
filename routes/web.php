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

Route::get('/', \App\Http\Controllers\QueriesController::class)->name('queries');
Route::get('/q/new', \App\Http\Controllers\CreateQueryFormController::class)->name('createQueryForm');
Route::post('/q/new', \App\Http\Controllers\CreateQueryProcessController::class)->name('createQueryProcess');
Route::get('/q/{query}', \App\Http\Controllers\SingleQueryController::class)->name('singleQuery');
Route::get('/q/{query}/sync', \App\Http\Controllers\ManualSyncQueryController::class)->name('manualSyncQuery');
