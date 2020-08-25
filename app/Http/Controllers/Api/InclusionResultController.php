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
<<<<<<< HEAD
        $prefecture_id = $request->input('prefecture_id');
        $data = Tschool::select()->where('prefecture_code', $prefecture_id)->get();
    	return $data;
=======
        $prefecture_id = $request->prefecture_id;
        $data = Tschool::where('prefecture_code', $prefecture_id)->get(['school_name', 'school_code']);
        return $data;
>>>>>>> 5220bafae27c5e9aef07b2ddd0ab7d424d0ecd9b
    }

}
