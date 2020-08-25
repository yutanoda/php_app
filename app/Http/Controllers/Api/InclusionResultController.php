<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Treport;
use App\Tschool;

class InclusionResultController extends Controller
{
    //
    public function index(Request $request)
    {
        $prefecture_id = $request->input('prefecture_id');
        $data = Tschool::select()->where('prefecture_code', $prefecture_id)->get();
    	return $data;
    }

}
