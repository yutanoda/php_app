<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tbranch extends Model
{
    //
    protected $table = 't_branch';
    public $timestamps = false;
    public function treport()
    {
        return $this->hasOne(Treport::class, 'branch_code');
    }
}
