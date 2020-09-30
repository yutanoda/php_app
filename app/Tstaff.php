<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tstaff extends Model
{
    //
	protected $table = 't_staff';
	public $timestamps = false;
	
	public function treport()
	{
			return $this->hasOne(Treport::class, 'staff_code');
	}

	public function tbranch()
	{
		return $this->belongsTo(Tbranch::class, 'branch_code', 'branch_code');
	}
}
