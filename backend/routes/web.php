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

Route::post('/task', function (Request $request) {
   request()->validate(
       [
           'name' => 'required|unique:tasks|min:3|max:255',
           'deadline' => 'required'
       ],
       [
           'name.required' => 'タスク内容を入力してください。',
           'name.unique' => 'そのタスクは既に追加されています。',
           'name.min' => '3文字以上で入力してください。',
           'name.max' => '255文字以内で入力してください。',
           'deadline.required' => '締め切りを入力してください。'
       ]
   );
   $task = new Task();
   $task->name = request('name');
   $task->deadline = request('deadline');
   $task->save();
   return redirect('/');
});

Route::delete('/task/{task}', function (Task $task) {
   $task->delete();
   return redirect('/');
});
