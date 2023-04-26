<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ForumController;



// 論壇
// Route::get('/forumIndex',[ForumController::class,'forumIndex'])->name('foindex');

Route::get('/forumQIndex',[ForumController::class,'forumQIndex'])->name('foqindex');

Route::get('/forumGIndex',[ForumController::class,'forumGIndex'])->name('fogindex');

Route::get('/forumHIndex',[ForumController::class,'forumHIndex'])->name('fohindex');

Route::get('/forumDetail/{sfid}/{foid}', [ForumController::class,'forumDetail'])->name('fodetail');

Route::get('/forumMessage', [ForumController::class,'getuserpic'])->name('fomes');

Route::post('/forumCom/{sfid}/{foid}',[ForumController::class,'forumCom'])->name('forumcom');

Route::post('/forumComEdit/{focid}',[ForumController::class,'forumComEdit'])->name('forumcomedit');

Route::get('/forumComDelect/{focid}',[ForumController::class,'forumComDelect'])->name('forumcomdelect');

Route::post('/forumMes', [ForumController::class,'forumMes'])->name('forummes');

Route::get('/forumSaved/{sfid}/{ftid}', [ForumController::class,'forumSaved'])->name('fosave');

Route::get('/forumUnsaved/{sfid}/{ftid}',[ForumController::class,'forumUnsaved'])->name('founsave');
