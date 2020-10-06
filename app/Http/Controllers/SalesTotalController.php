<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tuser;
use App\Tstaff;
use App\Treport;
use App\Tproposal;
use App\Tschool;
use App\Treportdetail;
use App\Tcommon;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class SalesTotalController extends Controller
{
     /**
     * 営業集計　初期表示
     * @param Request $request [description]
     */
    public function Index(Request $request)
    {
        //加算日（t_common/common_id=max_summary_spanの日数（value1）をプラスした日付）
        $add_day = Tcommon::where('common_id', 'max_summary_span')->first(['value1'])['value1'];
        if ( $request->start_date && $request->end_date) {
   
            $start_date = new Carbon($request->start_date);
            $end_date = new Carbon($request->end_date);

        } else {
            //システム開始日
            $start_date = new Carbon('2020-08-01');
            
            //終了日
            $end_date = $start_date->copy()->addDay($add_day);
        }

        $staffs = Tstaff::all();

        //報告書数
        $counts1 = DB::select('select staff_code,count(*) as cnt from t_report group by staff_code');
        foreach ($counts1 as $count1) {
            $treport_sum[$count1->staff_code] = $count1->cnt;
        }

       
        //検索結果をsessionで保持

        $request->session()->flash('start_date', $request->start_date);
        $request->session()->flash('end_date', $request->end_date);

        $data = [
            'staff_name' => $request->staff_name,
            'branch_name' => $request->branch_name,
            'authority_flag' => $request->authority_flag,
            'staffs' => $staffs,
            'treport_sum' => $treport_sum,

        ];
        
    	return view('totalsales_result', $data);
    }
}
