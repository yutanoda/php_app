<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tuser extends Model
{
    protected $table = 't_users';
    public $timestamps = false;
    protected $guarded = array('user_id');
    public function getData()
    {
        $data = DB::table($this->table)->get();

        return $data;
    }
}
