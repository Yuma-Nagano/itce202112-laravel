<!DOCTYPE html>
<html lang="ja">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Basic Tasks</title>
 <!-- <link type="text/css" rel="stylesheet" href="{{ asset('css/app.css') }}"> -->
 <link type="text/css" rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
 <div class="container">
   <h3 class="my-3">タスク管理ツール</h3>
   <div class="card mb-3">
     <div class="card-header">タスク新規追加</div>
     <div class="card-body">
       <form method="POST" action="{{ url('/task') }}">
         @csrf
         <div class="form-group">
           <p>タスク名</p>
           <input type="text" name="name" class="form-control">
           @if ($errors->has('name'))
           <p class="text-danger">{{ $errors->first('name') }}</p>
           @endif
           <p>締切</p>
           <input type="date" name="deadline" class="form-control">
           <button type="submit" class="btn btn-outline-info mt-2"><i class="fas fa-plus fa-lg mr-2"></i>追加</button>
         </div>
       </form>
     </div>
   </div>
   <div class="card">
     <div class="card-header">タスク一覧</div>
     <div class="card-body">
       @if (count($tasks) > 0)
       <table class="table table-striped">
         <tbody>
             <tr>
                 <th>タスク名</th>
                 <th>締め切り</th>
                 <th>作成日時</th>
                 <th></th> <!-- 削除ボタン -->
                </tr>
           @foreach ($tasks as $task)
           <tr>
             <td>{{ $task->name }}</td>
             <td>{{ $task->deadline }}</td>
             <td>{{ $task->created_at }}</td>

             <td>
               <form method="POST" action="{{ url('/task/' . $task->id) }}">
                 @csrf
                 @method('DELETE')
                 <button type="submit" class="btn btn-outline-danger" style="width: 100px;"><i class="far fa-trash-alt"></i> 削除</button>
               </form>
             </td>
           </tr>
           @endforeach
         </tbody>
       </table>
       @endif
     </div>
   </div>
 </div>
</body>
</html>
