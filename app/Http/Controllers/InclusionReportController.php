<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tuser;


class InclusionReportController extends Controller
{

    /**
    * 詳細ページ
    * @param Request $request [description]
    */
    public function Index(Request $request)
    {
        $data = [
            'staff_name' => $request->staff_name,
            'branch_name' => $request->branch_name,
            'authority_flag' => $request->authority_flag,
        ];


        return view('inclusion_report', $data);
    }


}
