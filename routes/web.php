<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ShowController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\BodyController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\NotificationController;



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


Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('/', [IndexController::class, 'index'])->name('index');

Route::get('/log/{id}', [ShowController::class, 'show'])->name('log.show');
Route::post('/log/comment/{id}', [CommentController::class, 'comment'])->name('log.comment');

//コメント通知
Route::get('/notification', [NotificationController::class, 'show'])->name('notification');
Route::get('/notification/{id}', [NotificationController::class, 'read'])->name('notification.read');

Route::get('/training', [TrainingController::class, 'new'])->middleware('auth')->name('training.new');
Route::post('/training', [TrainingController::class, 'create'])->middleware('auth')->name('training.create');

Route::get('/body', [BodyController::class, 'body'])->middleware('auth')->name('body');
Route::post('/body', [BodyController::class, 'create'])->middleware('auth')->name('body.create');

Route::get('/setting', [SettingController::class, 'setting'])->middleware('auth')->name('setting');
Route::post('/setting', [SettingController::class, 'change'])->middleware('auth')->name('setting.change');
Route::post('/setting/upload', [SettingController::class, 'upload'])->middleware('auth')->name('setting.upload');

Route::post('/like/{id}',[LikeController::class, 'add'])->name('like.add');

Route::get('/chartjs', function() {
    return view('chartjs');
});
Route::get('/chart-get', [ChartController::class, 'chartGet'])->name('chart-get');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::fallback(function () {
	return redirect('/');
});