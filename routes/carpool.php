<?php

use App\Http\Controllers\CarpoolController;
use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SendJoinNoticeMailController;
use App\Http\Middleware\CheckReturnDate;


Route::get('/carpool',[CarpoolController::class, 'cplist'])->name('cphome');
Route::get('/carpool/form',[CarpoolController::class, 'getdate'])->name('cpform');
Route::post('/carpool/form', [CarpoolController::class, 'create'])->middleware(CheckReturnDate::class);
Route::get('/carpool/info/{cpid}',[CarpoolController::class, 'showinfo'])->name('cpinfo');
Route::post('/carpool/info/{cpid}', [CarpoolController::class, 'join']);
Route::post('/carpool/info/comment/{cpid}', [CarpoolController::class, 'comment'])->name('cpcomment');

Route::get('/member/carpool',[CarpoolController::class, 'getcpinfo'])->name('mbcp');
Route::post('/member/carpool',[CarpoolController::class, 'comfirmjoin']);
Route::get('/carpool/info/{cpid}/edit',[CarpoolController::class, 'cpedit'])->name('cpedit');

// Route::view('/wel','welcome');
// Route::post('/test',[SendJoinNoticeMailController::class, 'store'])->name('test');
// Route::post('/test',[CarpoolController::class, 'test'])->name('test');