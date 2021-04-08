<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
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

Route::get('/', [MainController::class, 'index']);

Route::get('/contact',  function () {
    return view('pages.contact');
});

Route::get('/teacher'      , [TeachersController::class, 'index']);
/* Subjects */
Route::get('/subjects'     , [SubjectsController::class, 'index']);
Route::get('/subjects/show', [SubjectsController::class, 'show']);
Route::get('/subjects/new' , [SubjectsController::class, 'create']);
Route::get('/subjects/edit', [SubjectsController::class, 'edit']);
/* Tasks */
Route::get('/tasks'     , [TasksController::class, 'index']);
Route::get('/tasks/show', [TasksController::class, 'show']);
Route::get('/tasks/new' , [TasksController::class, 'create']);
Route::get('/tasks/edit', [TasksController::class, 'edit']);