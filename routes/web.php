<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentSubjectsController;
use App\Http\Controllers\TeacherSubjectsController;
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

/* Pages */
Route::get('/', [HomeController::class, 'index']);
Route::get('/contact', [HomeController::class, 'contact']);
Route::get('/teachers', [HomeController::class, 'index']);
Route::get('/students', [HomeController::class, 'index']);

/* Authentification */
Auth::routes();

/* Teachers Subjects */
Route::get('/teachers/subjects/', [TeacherSubjectsController::class, 'index']);
Route::get('/teachers/subjects/create', [TeacherSubjectsController::class, 'create']);
Route::get('/teachers/subjects/{subject_id}', [TeacherSubjectsController::class, 'show']);
Route::post('/teachers/subjects', [TeacherSubjectsController::class, 'store']);
Route::delete('/teachers/subjects/{subject_id}', [TeacherSubjectsController::class, 'destroy']);
Route::get('/teachers/subjects/{subject_id}/edit', [TeacherSubjectsController::class, 'edit']);
Route::put('/teachers/subjects/{subject_id}', [TeacherSubjectsController::class, 'update']);

/* Tasks */
Route::resource('tasks', TasksController::class);
Route::get('/tasks/{task_id}/evaluate/{solution_id}', [TasksController::class, 'evaluation']);
Route::put('/tasks/{id}/evaluate', [TasksController::class, 'evaluate']);
Route::get('/tasks/{id}/submit', [TasksController::class, 'submission']);
Route::post('/tasks/{id}', [TasksController::class, 'submit']);

/* Students Routes */
Route::get('/students/subjects/', [StudentSubjectsController::class, 'index']);
Route::get('/students/subjects/new', [StudentSubjectsController::class, 'take']);
Route::get('/students/subjects/{subject_id}', [StudentSubjectsController::class, 'show']);
Route::post('/students/subjects', [StudentSubjectsController::class, 'store']);
Route::delete('/students/subjects/{subject_id}', [StudentSubjectsController::class, 'drop']);