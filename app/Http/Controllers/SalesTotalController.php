<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tuser;


class SalesTotalController extends Controller
{
    
     /**
     * 営業集計　初期表示
     * @param Request $request [description]
     */
    public function Index(Request $request)
    {

        $data = [
            'staff_name' => $request->staff_name,
            'branch_name' => $request->branch_name,
            'authority_flag' => $request->authority_flag,
        ];

    	return view('individual_result', $data);
    }


}
