<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tstaff extends Model
{
    //
	protected $table = 't_staff';
	public $timestamps = false;
	
	public function treports()
	{
			return $this->hasMany(Treport::class, 'staff_code', 'staff_code');
	}

	public function tproposals()
	{
			return $this->hasMany(Tproposal::class, 'staff_code', 'staff_code');
	}

	public function tbranch()
	{
		return $this->belongsTo(Tbranch::class, 'branch_code', 'branch_code');
	}

	public function treportdetails()
	{
			return $this->hasManyThrough(
					'App\Treportdetail',
					'App\Treport',
					'staff_code', // Foreign key on users table...
					'report_number', // Foreign key on posts table...
					'staff_code', // Local key on countries table...
					'report_number' // Local key on users table...
			);
	}
}
