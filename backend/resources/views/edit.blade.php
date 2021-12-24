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
        <div class="card-header">タスク編集</div>
        <div class="card-body">
            <form method="POST" action="{{ url('/task/update') }}">
                @csrf
                <div class="form-group">
                    <p>名前: {{ $task->name }}</p>
                    <input type="text" name="name" class="form-control"
                    value="{{ is_null(old('name')) ? $task->name : old('name') }}">
                    @if ($errors->has('name'))
                    <p class="text-danger">{{ $errors->first('name') }}</p>
                    @endif

                    <p>締切: {{ $task->deadline }}</p>
                    <input type="datetime-local" name="deadline" class="form-control"
                    value="{{ is_null(old('deadline')) ? date('Y-m-d\TH:i', strtotime($task->deadline)) : old('deadline') }}">
                    @if ($errors->has('deadline'))
                    <p class="text-danger">{{ $errors->first('deadline') }}</p>
                    @endif

                    <input type="hidden" name="id" value="{{ $task->id }}">

                    <button type="submit" class="btn btn-outline-info mt-2"><i class="fas fa-plus fa-lg mr-2"></i>更新</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
