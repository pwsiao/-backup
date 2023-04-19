<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;


Route::get('/member/carpool',[MemberController::class, 'getcpinfo'])->name('mbcp');
Route::post('/member/carpool',[MemberController::class, 'comfirmjoin']);
// Route::view('/member/info','member.member-info')->name('mbinfo');
Route::view('/member/feel','member.feel')->name('mbfeel');
Route::view('/member/forum','member.forum')->name('mbforum');
Route::view('/member/save','member.save')->name('mbsave');

Route::middleware('auth')->group(function () {
    // Route::view('/member/info','member.member-info')->name('mbinfo');
    Route::get('/member/info', [ProfileController::class, 'edit'])->name('mbinfo');
    Route::post('/member/info', [ProfileController::class, 'update'])->name('mbinfo.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




