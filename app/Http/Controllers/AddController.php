<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Repositories\Task\TaskDataAccessRepositoryInterface AS TaskDataAccess;

class AddController extends Controller
{

    protected $Task;
    public function __construct(TaskDataAccess $TaskDataAccess)
    {
        $this -> Task = $TaskDataAccess;
    }


    public function dispay($tasks){
        $start = microtime(true);

//        処理内容表示するため
        $memory = memory_get_usage();

        // ここでデータ取得を行う
        $data = $this->Task->getAll();

        $result = [
            // どちらのリポジトリを使用しているかわかるように
            'name'      => get_class($this->Task),
            // 実行時間
            'time'      => microtime(true) - $start,
            // 使用メモリ
            'memory'    => (memory_get_peak_usage() - $memory) / (1024 * 1024),
            'items' => $tasks,
        ];

        // 結果出力
        var_dump($result);
    }
    public function index(Request $request)
    {
        $tasks = $this -> Task -> getAll();


        return view('index', ['items' => $tasks]);
    }
//    作業中の
    public function working_index(Request $request)
    {
        $tasks = $this -> Task -> WhereGetSelect('status',0);
//        $tasks = Task::where('status',0)->get();

        return view('index', ['items' => $tasks]);
    }
    public function done_index(Request $request)
    {
        $tasks = $this -> Task -> WhereGetSelect('status',1);

//        $tasks = Task::where('status',1)->get();

        return view('index', ['items' => $tasks]);
    }

    public function create(Request $request)
    {
        $this->validate($request, Task::$rules);
        $task = new Task;
        $form = $request->all();
        unset($form['_token']);
//        0は作業中、１は完了を表す
//       初期値は作業中の0
        $task->status = 0;
        $task->fill($form)->save();
        return redirect('/index');
    }


//作業中ボタンをクリックしたときのidのdatabaseを探してきて、indexページのitemsにわたす。
    public function edit($id)
    {

        return view('index', ['items' => Task::find($id)]);
    }
    //作業中ボタンをクリックしたときのidのdatabaseを探してくる。
//    ボタンクリックしたときのidからdatabaseを探して、$taskに代入
//firstで単一レコードを取り出す。
//単一レコードのstatusが作業中、完了に分けてupdateする。

    public function update($id)
    {
//        $task = $this -> Task ->WhereGetSelect('id',$id)->get();
//        $task = Task::where('id', $id);
//        完了１ならば０に
        $task = $this -> Task -> WhereGetSelect('id',$id)->first();
        var_dump($task);
        if  ($task->status) {
            $this->dispay($task);
            $task = $this  -> Task -> UpdateSelect($id,'status',0);
            $this->dispay($task);

        }
        else{
            $this->dispay($task);
            $task = $this -> Task -> UpdateSelect($id,'status',1);
            $this->dispay($task);

        }
//       更新後のデータを呼び出す
        $task = $this -> Task -> getAll();
        return view('index', ['items' => $task ]);

    }

    public function destroy($id)
    {
        $this -> Task -> deleteSelect($id);
        return redirect()->route('index.add');
    }


}


