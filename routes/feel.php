<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeelController;


Route::get('/feelDetail/{id}',[FeelController::class,'feelDetail'])->name('fedetail');

Route::get('/feelIndex', [FeelController::class,'feelIndex'])->name('feindex');

Route::get('/feelMessage/{uid}', [FeelController::class,'getuserpic'])->name('femes');

Route::post('/feelCom/{ftid}/{uid}',[FeelController::class,'feelCom'])->name('feelcom');

Route::post('/feelMes/{uid}', [FeelController::class,'feelMes'])->name('feelmes');

Route::get('/feelSaved/{uid}/{ftid}',[FeelController::class,'feelSaved'])->name('fesave');

Route::get('/feelUnsaved/{uid}/{ftid}',[FeelController::class,'feelUnsaved'])->name('feunsave');

// Route::post('feelMesSaved/{uid}', [FeelController::class,'feelMesSaved']);

