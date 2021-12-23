<!DOCTYPE html>
<html lang="ja">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Basic Tasks</title>
 <!-- <link type="text/css" rel="stylesheet" href="{{ asset('css/app.css') }}"> -->
 <link type="text/css" rel="stylesheet" href="{{ mix('css/app.css') }}">
 <link type="text/css" rel="stylesheet" href="{{ asset('css/style.css') }}">
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
           <input type="text" name="name" class="form-control"  value="{{ old('name') }}">
           @if ($errors->has('name'))
           <p class="text-danger">{{ $errors->first('name') }}</p>
           @endif

           <p>締切</p>
           <input type="date" name="deadline" class="form-control"  value="{{ old('deadline') }}">
           @if ($errors->has('deadline'))
           <p class="text-danger">{{ $errors->first('deadline') }}</p>
           @endif

           <button type="submit" class="btn btn-outline-info mt-2"><i class="fas fa-plus fa-lg mr-2"></i>追加</button>
         </div>
       </form>
     </div>
   </div>

    <div class="card mb-3">
        <div class="card-header">検索</div>
        <div class="card-body">
            <form method="get" action="{{ url('/task') }}">
                @csrf
                <div class="form-group">
                    <div class="form-check form-check-inline">
                        <input type="checkbox" class="form-check-input" id="notCompleted" name="notCompleted" value="0" checked>
                        <label class="form-check-label" for="notCompleted">未完了</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="checkbox" class="form-check-input" id="completed" name="completed" value="1">
                        <label class="form-check-label" for="completed">完了</label>
                    </div>

                    <div>
                        <label class="form-label" for="startDeadline">締め切り</label>
                        <input type="datetime-local" class="form-control" id="startDeadline" name="startDeadline">
                        <span>~</span>
                        <input type="datetime-local" class="form-control" id="endDeadline" name="endDeadline">
                    </div>

                    <div>
                        <label class="form-label" for="freeWord">フリーワード</label>
                        <input type="text" class="form-control" id="freeWord" name="freeWord">
                    </div>
                    
                    <button type="submit" class="btn btn-primary mt-2">検索</button>
                </div>
            </form>
        </div>
    </div>

   <div class="card">
     <div class="card-header">タスク一覧</div>
     <div class="card-body">
       @if (count($tasks) > 0)
       <table class="table">
         <tbody>
             <tr>
                 <th>タスクの状態</th>
                 <th>完了状態変更</th>
                 <th>タスク名</th>
                 <th>締め切り</th>
                 <th>作成日時</th>
                 <th></th> <!-- 削除ボタン -->
                </tr>
           @foreach ($tasks as $task)
           <!-- {{ $date_diff = intval($current_time->diff(new DateTime($task->deadline))->format('%R%a')) }} -->
           <!-- {{ $deadline_state = 0 > $date_diff ? 'danger' : ( 3 > $date_diff ? 'warning' : '' ) }} -->
           <tr class="{{ $deadline_state === 'danger' ? 'table-danger' :  ( $deadline_state === 'warning' ? 'table-warning' : '' ) }}">
            <td>{{ $task->is_completed ? '完了' : '未完了' }}</td>
            <td>
                <form method="POST" action="{{ url('/complete/' . $task->id) }}">
                @csrf
                @if(!$task->is_completed)
                    <button type="submit" class="btn btn-success w-75">完了に変更</button>
                @else
                    <button type="submit" class="btn btn-secondary w-75">未完了に変更</button>
                @endif
                </form>
            </td>
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
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item {{ !$tasks->hasPages() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $tasks->previousPageUrl() }}" {{ !$tasks->hasPages() ? 'tabindex="-1" aria-disabled="true"' : ''}}>Previous</a>
                </li>
                @for ( $page_num = 1 ; $tasks->lastPage() >= $page_num ; $page_num++)
                    <li class="page-item {{ $tasks->currentPage() === $page_num ? 'active' : '' }}">
                        <a class="page-link" href="{{ $tasks->url($page_num) }}">{{ $page_num }}</a>
                    </li>
                @endfor
                <li class="page-item {{ !$tasks->hasPages() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $tasks->nextPageUrl() }}" {{ !$tasks->hasPages() ? 'tabindex="-1" aria-disabled="true"' : ''}}>Next</a>
                </li>
            </ul>
        </nav>
       @endif
     </div>
   </div>
 </div>
</body>
</html>
