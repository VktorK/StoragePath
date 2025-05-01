<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StorageController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/storage', [StorageController::class, 'index'])->name('storage.index');