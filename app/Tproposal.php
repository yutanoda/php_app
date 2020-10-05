<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tproposal extends Model
{
    //
	protected $table = 't_proposal';
	public $timestamps = false;

	public function tstaff()
	{
		return $this->belongsTo(Tstaff::class, 'staff_code', 'staff_code');
	}
}
