<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\CarpoolController;


// 首頁
Route::get('/',[IndexController::class,'Index'])->name('home');



Route::middleware('auth')->group(function () {
    Route::get('/notice', [CarpoolController::class, 'cpjoinNotice'])->name('notice');
});

require __DIR__.'/auth.php';
