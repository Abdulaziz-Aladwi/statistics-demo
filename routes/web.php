<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Home\HomeController;
use App\Http\Controllers\Admin\Statistics\StatisticsController;
use App\Http\Controllers\Admin\Task\TaskController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::redirect('/', 'admin');

Route::group(['middleware' => 'auth', 'prefix' => 'admin','as' => 'admin.'], function(){
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::resource('tasks', TaskController::class)->only(['index', 'create', 'store']);
    Route::get('statistics', [StatisticsController::class, 'index'])->name('statistics.index');
});

Auth::routes(['register' => false, 'reset' => false]);
