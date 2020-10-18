<?php


namespace App\Repositories\Task;
use App\Models\Task;
use DB;

interface TaskDataAccessRepositoryInterface
{

    public function getAll();
    public function findAll($id);
    public function deleteSelect($id);
    public function WhereGetSelect($select_key,$id);
    public function UpdateSelect($id,$key,$value);


}
