@extends('parent')

<body>

@section('content')
    {{--    データベースの値を$itemsとして受け取って、foreachで表示--}}
    @foreach ( $items as $task)

        <table>
            {{--            idを振り直す　$loop->iteration --}}
            <td>{{$loop->iteration}}</td>
            <td>{{$task -> comment}}</td>
            {{--            作業中と表示　$tasksからステータスを撮ってくる。--}}

{{--            statusボタンクリック時にeditアクションを実行する--}}
            <form action="{{route('index.edit' , [$task->id]) }}" method="post">                <th>
                    @csrf
                    <button type="submit">
            @if ($task->status)
                {{"完了"}}
                            @else()
                {{'作業中'}}
                        @endif

                    </button>
                </th>
            </form>
            <form action="{{route('index.destroy' , [$task->id]) }}" method="post">                <th>
                @csrf

            <th><button>削除</button></th>
            </form>

        </table>
    @endforeach
@endsection

@section('input')

    @if (count($errors) > 0)
        <div>
            <ul>
                @foreach($errors -> all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h2>新規タスクの追加</h2>

    <form action="index" method="post">
        @csrf
        <input type="text" name="comment" value="{{old('comment')}}">
        <input type="submit" value="追加">
    </form>

@endsection
</body>
