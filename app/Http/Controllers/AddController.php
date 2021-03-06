<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class AddController extends Controller
{

    public function add(Request $request){
        $tasks = Task::all();
        return view('index',['items'=>$tasks]);

    }
    public function create(Request $request){
        $this -> validate($request,Task::$rules);
        $task = new Task;
        $form = $request -> all();
        unset($form['_token']);
        $task -> status = '作業中';
        $task -> fill($form)-> save();
        return redirect('/index');
    }

//作業中ボタンをクリックしたときのidのdatabaseを探してきて、indexページのitemsにわたす。
    public function edit($id){

        return view('index',['items'=>Task::find($id)]);
    }
    //作業中ボタンをクリックしたときのidのdatabaseを探してくる。
//    ボタンクリックしたときのidからdatabaseを探して、$taskに代入
//firstで単一レコードを取り出す。
//単一レコードのstatusが作業中、完了に分けてupdateする。

    public function update($id){

        $task = Task::where('id',$id);
        if ($task->first()->status === '作業中') {
            $task->update(['status' => '完了']);
        }
        elseif ($task->first()->status ==='完了') {
            $task->update(['status' => '作業中']);
        }
        return view('index',['items'=>Task::all()]);

    }

    public function destroy($id)
    {
        $tasks = Task::find($id);
        $tasks->delete();

        return redirect()->route('task.add');
    }
}
