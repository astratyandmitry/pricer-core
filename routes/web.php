<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return redirect()->route('query.list');
});

Route::get('/queries', \App\Http\Controllers\QueryListController::class)->name('query.list');
Route::get('/query/new', \App\Http\Controllers\QueryNewFormController::class)->name('query.new');
Route::post('/query/new', \App\Http\Controllers\QueryNewProcessController::class)->name('query.new');
Route::get('/query/{query}', \App\Http\Controllers\QueryDetailController::class)->name('query.detail');
Route::get('/query/{query}/sync', \App\Http\Controllers\QuerySyncController::class)->name('query.sync');
Route::get('/advert/{advert}', \App\Http\Controllers\AdvertDetailController::class)->name('advert.detail');
Route::get('/advert/{advert}/sync', \App\Http\Controllers\AdvertSyncController::class)->name('advert.sync');
