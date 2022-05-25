<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();


Route::group(['middleware' => ['auth', 'role:client']], function() {
    Route::get('/', [App\Http\Controllers\FeedbackController::class, 'index'])->name('feedback.form');
    Route::post('/save', [App\Http\Controllers\FeedbackController::class, 'save'])->name('feedback.save');
});

Route::group(['middleware' => ['auth', 'role:manager']], function() {
    Route::get('/list', [App\Http\Controllers\Admin\ManagerController::class, 'index'])->name('manager.list');
});
