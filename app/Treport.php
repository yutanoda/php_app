<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Treport extends Model
{
    //
	protected $table = 't_report';
	public $timestamps = false;
	protected $dates = ['submitted_datetime'];
	public function tstaff()
	{
		return $this->belongsTo(Tstaff::class, 'staff_code', 'staff_code');
	}
	public function tbranch()
	{
		return $this->belongsTo(Tbranch::class, 'branch_code', 'branch_code');
	}
	public function treportdetails()
	{
		return $this->hasMany(Treportdetail::class, 'report_number');
	}
}
