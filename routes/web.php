<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return redirect()->route('subscription.list');
})->name('home');

Route::get('/subscriptions', \App\Http\Controllers\SubscriptionListController::class)->name('subscription.list');
Route::post('/subscriptions', \App\Http\Controllers\SubscriptionStoreController::class)->name('subscription.new');
Route::get('/subscription/{subscription}', \App\Http\Controllers\SubscriptionDetailController::class)->name('subscription.detail');
Route::get('/subscription/{subscription}/sync', \App\Http\Controllers\SubscriptionSyncController::class)->name('subscription.sync');
Route::get('/advert/{advert}', \App\Http\Controllers\AdvertDetailController::class)->name('advert.detail');
