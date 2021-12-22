<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Datetime;
use Illuminate\Http\Request;


class TaskController extends Controller
{
    public function index()
    {
        return view('tasks', [
            'tasks' => Task::paginate(10),
            'current_time' => new DateTime()
        ]);
    }

    public function create(Request $request)
    {
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
        $task->is_completed = false;
        $task->save();
        return redirect('/');
    }

    public function search(Request $request) {
        $task = new Task();
        // //TODO: whereInメソッドで短くかけるかもしれない
        // if(!is_null($request->completed) && !is_null($request->notCompleted)){
        // }elseif(!is_null($request->completed)){
        //     $task = $task->where(['is_completed', '=', true]);
        // }elseif(!is_null($request->notCompleted)){
        //     $task = $task->where(['is_completed', '=', false]);
        // }else{
        //     return view('tasks', ['current_time' => new DateTime()]);
        // }

        $task = $task->whereDate('deadline', '>=', $request->startDeadline);
        $task = $task->whereDate('deadline', '<=', $request->endDeadline);

        return view('tasks', [
            'tasks' => $task->paginate(10),
            'current_time' => new DateTime()
        ]);
    }

    public function delete($id) {
        $task = new Task();
        $task->find($id)->delete();
        return redirect('/');
    }

    public function toggleTaskCompletion($id){
        $tasks = new Task();
        $task = $tasks->find($id);
        if($task->is_completed){
            $task->update(['is_completed' => false]);
        }else{
            $task->update(['is_completed' => true]);
        }
        return redirect('/');
    }

}
