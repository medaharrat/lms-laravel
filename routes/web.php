<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TeachersController;
use App\Http\Controllers\SubjectsController;
use App\Http\Controllers\TasksController;

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

Route::get('/', [HomeController::class, 'index']);

Route::get('/contact',  function () {
    return view('pages.contact');
});

/* Authentification */
Auth::routes();
/* Teachers Routes */
Route::get('/teacher', [TeachersController::class, 'index']);
/* Subjects */
Route::resource('subjects', SubjectsController::class);
/* Tasks */
Route::resource('tasks', TasksController::class);
/* 
*   Students Routes 
*/