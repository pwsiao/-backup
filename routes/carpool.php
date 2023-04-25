<?php

use App\Http\Controllers\CarpoolController;
use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SendJoinNoticeMailController;
use App\Http\Middleware\CheckReturnDate;


Route::get('/carpool', [CarpoolController::class, 'cplist'])->name('cphome');
Route::post('/carpool', [CarpoolController::class, 'cplist']);
Route::get('/carpool/form', [CarpoolController::class, 'getdate'])->name('cpform');
Route::post('/carpool/form', [CarpoolController::class, 'create'])->middleware(CheckReturnDate::class)->name('cpform');
Route::get('/carpool/info/{cpid}', [CarpoolController::class, 'showinfo'])->name('cpinfo');
Route::post('/carpool/info/{cpid}', [CarpoolController::class, 'join'])->name('cpjoin');
Route::post('/carpool/info/comment/{cpid}', [CarpoolController::class, 'comment'])->name('cpcomment');

Route::middleware('auth')->group(function () {
    Route::get('/member/carpool', [CarpoolController::class, 'getcpinfo'])->name('mbcp');
    Route::post('/member/carpool', [CarpoolController::class, 'comfirmjoin'])->name('comfirmjoin');
    Route::post('/member/carpool/cancel', [CarpoolController::class, 'cancel'])->name('canceljoin');
});

Route::post('/carpool/edit', [CarpoolController::class, 'edit'])->name('cpedit');
Route::post('/carpool/update', [CarpoolController::class, 'update'])->name('cpupdate');
Route::post('/carpool/delete', [CarpoolController::class, 'delete'])->name('cpdelete');

// Route::view('/wel','welcome');
// Route::post('/test',[SendJoinNoticeMailController::class, 'store'])->name('test');
// Route::post('/test',[CarpoolController::class, 'test'])->name('test');