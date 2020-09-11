<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tlogin extends Model
{
    protected $fillable = [
				'login_flag',
				'logout_datetime',
    ];
    //
	protected $table = 't_login';
	public $timestamps = false;
	protected $primaryKey = 'login_number';
}
