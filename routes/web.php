<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CarpoolController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\SendJoinNoticeMailController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FeelController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\IndexController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('index');
// });

Route::get('/carpool',[CarpoolController::class, 'cplist'])->name('cphome');
Route::view('/carpool/form','carpool.cpform')->name('cpform');
Route::post('/carpool/form', [CarpoolController::class, 'create']);
Route::get('/carpool/info/{cpid}',[CarpoolController::class, 'showinfo'])->name('cpinfo');
Route::post('/carpool/info/{cpid}', [CarpoolController::class, 'join']);
Route::post('/carpool/info/{cpid}', [CarpoolController::class, 'comment']);

// Route::view('/wel','welcome');
// Route::post('/test',[SendJoinNoticeMailController::class, 'store'])->name('test');
// Route::get('/test',[CarpoolController::class, 'test']);

Route::get('/member/carpool',[MemberController::class, 'getcpinfo'])->name('mbcp');
Route::post('/member/carpool',[MemberController::class, 'comfirmjoin']);
Route::view('/member/info','member.member-info')->name('mbinfo');
Route::view('/member/feel','member.feel')->name('mbfeel');
Route::view('/member/forum','member.forum')->name('mbforum');
Route::view('/member/save','member.save')->name('mbsave');


// 首頁
Route::get('/',[IndexController::class,'Index'])->name('home');

// 心得
Route::get('/feelDetail/{id}',[FeelController::class,'feelDetail'])->name('fedetail');

Route::get('/feelIndex', [FeelController::class,'feelIndex'])->name('feindex');

Route::get('/feelMessage/{uid}', [FeelController::class,'getuserpic'])->name('femes');

Route::post('/feelCom/{ftid}/{uid}',[FeelController::class,'feelCom'])->name('feelcom');

Route::post('/feelMes/{uid}', [FeelController::class,'feelMes'])->name('feelmes');

Route::get('/feelSaved/{uid}/{ftid}',[FeelController::class,'feelSaved'])->name('fesave');

Route::get('/feelUnsaved/{uid}/{ftid}',[FeelController::class,'feelUnsaved'])->name('feunsave');

// Route::post('feelMesSaved/{uid}', [FeelController::class,'feelMesSaved']);



// 論壇
Route::get('/forumIndex',[ForumController::class,'forumIndex'])->name('foindex');

Route::get('/forumDetail/{sfid}/{foid}', [ForumController::class,'forumDetail'])->name('fodetail');

Route::get('/forumMessage/{uid}', [ForumController::class,'getuserpic'])->name('fomes');

Route::post('/forumCom/{sfid}/{foid}/{uid}',[ForumController::class,'forumCom'])->name('forumcom');

Route::post('/forumMes/{uid}', [ForumController::class,'forumMes'])->name('forummes');

Route::get('/forumSaved/{sfid}/{uid}/{ftid}', [ForumController::class,'forumSaved'])->name('fosave');

Route::get('/forumUnsaved/{sfid}/{uid}/{ftid}',[ForumController::class,'forumUnsaved'])->name('founsave');

// Route::post('/forumMesSaved/{uid}', [ForumController::class,'forumMesSaved']);





Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
