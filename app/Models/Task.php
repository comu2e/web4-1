<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['comment'];

    public $timestamps = false;
    public static $rules = array(
       'comment' => 'required'
    );
   public function getData(){
       return $this -> comment ;
   }
}
