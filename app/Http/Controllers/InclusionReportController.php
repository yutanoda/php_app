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
    	// if ( empty($request->session()->get('user_id')) ) {
      //       return redirect('/');
      //   }

      //   $user_record = Tuser::where('user_id', $request->session()->get('user_id'))->where('valid_flag', 1)->first();
      //   $data = [
      //       'authority_flag' => $user_record->authority_flag,
      //   ];
    	// return view('inclusion_report', $data);
    	return view('inclusion_report');
    }


}
