<?php

use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// 個人頁面

// Route::view('/member/info','member.member-info')->name('mbinfo');
Route::middleware('auth')->group(function () {
    // 個人資料
    Route::view('/member/info', 'member.member-info')->name('mbinfo');
    Route::get('/member/info', [ProfileController::class, 'edit'])->name('mbinfo');
    Route::post('/member/info', [ProfileController::class, 'update'])->name('mbinfo.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 論壇
    Route::get('/member/forum', [MemberController::class, 'getForumList'])->name('mbforum');
    Route::post('/editForum', [MemberController::class, 'editForum'])->name('editForum');
    Route::post('/editForum/done', [MemberController::class, 'editForumDone'])->name('editForumDone');
    Route::delete('/delForum/{foid}', [MemberController::class, 'delForum'])->name('delForum');

    // 心得
    Route::get('/member/feel', [MemberController::class, 'getFeelList'])->name('mbfeel');
    Route::post('/editFeel', [MemberController::class, 'editFeel'])->name('editFeel');
    Route::post('/editFeel/done', [MemberController::class, 'editFeelDone'])->name('editFeelDone');
    Route::delete('/delFeel/{fid}', [MemberController::class, 'delFeel'])->name('delFeel');

    // 收藏
    Route::get('/member/save', [MemberController::class, 'getSaveList'])->name('mbsave');
    Route::post('/member/save/goToForum', [MemberController::class, 'goToForum'])->name('goToForum');
});