<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Treportdetail extends Model
{
    //
	protected $table = 't_report_detail';
	public $timestamps = false;
	public function treport()
{
    return $this->hasOne(Treport::class, 'report_number');
}
}
