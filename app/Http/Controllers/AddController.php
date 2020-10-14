<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class AddController extends Controller
{

    public function index(Request $request)
    {
        $tasks = Task::all();
        return view('index', ['items' => $tasks]);
    }
//    作業中の
    public function working_index(Request $request)
    {
        $tasks = Task::where('status',0)->get();
        return view('index', ['items' => $tasks]);
    }
    public function done_index(Request $request)
    {
        $tasks = Task::where('status',1)->get();
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

        $task = Task::where('id', $id);
//        完了１ならば０に
        if  ($task->first()->status) {
            $task->update(['status' =>0]);
        }
        else{
            $task->update(['status' =>1]);

        }
        return view('index', ['items' => Task::all()]);

    }

    public function destroy($id)
    {
        $tasks = Task::find($id);
        $tasks->delete();

        return redirect()->route('index.add');
    }


}


