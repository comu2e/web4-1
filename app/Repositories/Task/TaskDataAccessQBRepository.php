<?php

namespace App\Repositories\Task;
use App\Models\Task;
use DB;

class TaskDataAccessQBRepository implements TaskDataAccessRepositoryInterface
{
    protected $table = 'tasks';

    public function getAll()
    {
        return DB::table($this->table)->get();
    }

    public function findAll($id)
    {
        return DB::table($this->table)->find($id);
    }
    public function deleteSelect($id)
    {

       return DB::table($this->table)->where('id',$id)->delete();
    }

    public function WhereGetSelect($select_key,$id){
        return DB::table($this->table)->where($select_key,$id)->get();

    }

    public function UpdateSelect($id,$key,$value)
    {
//        where　idで指定したタスクを更新する。（valueは0,1をとる）
//        keyはstatusをとる
        return  DB::table($this -> table ) -> where("id",$id)->update([$key=>$value]);

    }
}
