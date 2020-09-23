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
        $prefecture_id = $request->prefecture_id;
        $data = Tschool::where('prefecture_code', $prefecture_id)->orderBy('school_name', 'asc')->get(['school_name', 'school_code']);
        return $data;
    }

}
