<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ForumController;


Route::get('/forumIndex',[ForumController::class,'forumIndex'])->name('foindex');

Route::get('/forumDetail/{sfid}/{foid}', [ForumController::class,'forumDetail'])->name('fodetail');

Route::get('/forumMessage/{uid}', [ForumController::class,'getuserpic'])->name('fomes');

Route::post('/forumCom/{sfid}/{foid}/{uid}',[ForumController::class,'forumCom'])->name('forumcom');

Route::post('/forumMes/{uid}', [ForumController::class,'forumMes'])->name('forummes');

Route::get('/forumSaved/{sfid}/{uid}/{ftid}', [ForumController::class,'forumSaved'])->name('fosave');

Route::get('/forumUnsaved/{sfid}/{uid}/{ftid}',[ForumController::class,'forumUnsaved'])->name('founsave');

// Route::post('/forumMesSaved/{uid}', [ForumController::class,'forumMesSaved']);

