<?php

use Illuminate\Support\Facades\Route;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\TaskController;

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

Route::get('/', [TaskController::class, 'index']);

Route::post('/task/create', [TaskController::class, 'create']);

Route::delete('/task/delete/{id}', [TaskController::class, 'delete']);

Route::post('/task/complete/{id}', [TaskController::class, 'toggleTaskCompletion']);

Route::get('/task/edit/{id}', [TaskController::class, 'edit']);

Route::post('/task/update', [TaskController::class, 'update']);
