<?php

use App\Http\Controllers\CarpoolController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SendJoinNoticeMailController;


Route::get('/carpool',[CarpoolController::class, 'cplist'])->name('cphome');
Route::view('/carpool/form','carpool.cpform')->name('cpform');
Route::post('/carpool/form', [CarpoolController::class, 'create']);
Route::get('/carpool/info/{cpid}',[CarpoolController::class, 'showinfo'])->name('cpinfo');
Route::post('/carpool/info/{cpid}', [CarpoolController::class, 'join']);
Route::post('/carpool/info/comment/{cpid}', [CarpoolController::class, 'comment'])->name('cpcomment');

// Route::view('/wel','welcome');
// Route::post('/test',[SendJoinNoticeMailController::class, 'store'])->name('test');
// Route::post('/test',[CarpoolController::class, 'test'])->name('test');