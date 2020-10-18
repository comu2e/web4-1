<?php

namespace App\Repositories\Task;

use App\Models\Task;

class TaskDataAccessEQRepository implements TaskDataAccessRepositoryInterface
{
    public function getAll()
    {
        return Task::all();
    }
    public function findAll($id)
    {
        return Task::find($id);
    }

    public function UpdateSelect($id,$key,$value)
    {
        //すでにwhere　idで指定ししたtaskを更新する。
        return  Task::where("id",$id)->update([$key=>$value]);

    }

    public function deleteSelect($id)
    {

        return Task::where('id',$id,)->delete();
    }
    public function WhereGetSelect($select_key,$id)
    {

        return Task::where($select_key,$id,)->get();
    }

}
