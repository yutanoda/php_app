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
        $counts1 = DB::select('SELECT t_staff.staff_code,count(*) AS cnt FROM t_staff JOIN t_report  ON t_staff.staff_code = t_report.staff_code
                   WHERE t_report.status_flag = 1 AND t_report.valid_flag = 1 GROUP BY t_staff.staff_code');
        if ($counts1) {
            foreach ($counts1 as $count1) {
                $treport_sum[$count1->staff_code] = $count1->cnt;
            }
        }else {
            $treport_sum = [];
        }

        //要望書数
        $counts2 = DB::select('SELECT t_staff.staff_code,count(*) AS cnt FROM t_staff JOIN t_proposal  ON t_staff.staff_code = t_proposal.staff_code
                   WHERE t_proposal.status_flag = 1 AND t_proposal.valid_flag = 1 GROUP BY t_staff.staff_code');
        if ($counts2) {
            foreach ($counts2 as $count2) {
                $tproposal_sum[$count2->staff_code] = $count2->cnt;
            }
        }else {
            $tproposal_sum = [];
        }

        //営業校数
        $counts3 = DB::select('SELECT t_staff.staff_code,count(*) AS cnt FROM t_staff 
                    JOIN t_report  ON t_staff.staff_code = t_report.staff_code
                    JOIN t_report_detail ON t_report.report_number = t_report_detail.report_number
                    WHERE t_report.status_flag = 1 AND t_report.valid_flag = 1
                    GROUP BY t_staff.staff_code');
        if ($counts3) {
            foreach ($counts3 as $count3) {
                $treport_detail_sum[$count3->staff_code] = $count3->cnt;
            }
        }else {
            $treport_detail_sum = [];
        }

        //新規数
        $counts4 = DB::select('SELECT t_staff.staff_code,count(*) AS cnt FROM t_staff 
                    JOIN t_report  ON t_staff.staff_code = t_report.staff_code
                    JOIN t_report_detail ON t_report.report_number = t_report_detail.report_number
                    WHERE t_report.status_flag = 1 AND t_report.valid_flag = 1 AND t_report_detail.report1 != ""
                    GROUP BY t_staff.staff_code');
        
        if ($counts4) {
            foreach ($counts4 as $count4) {
                $new_sum[$count4->staff_code] = $count4->cnt;
            }
        }else {
            $new_sum = [];
        }

        //継続数
        $counts5 = DB::select('SELECT t_staff.staff_code,count(*) AS cnt FROM t_staff 
                    JOIN t_report  ON t_staff.staff_code = t_report.staff_code
                    JOIN t_report_detail ON t_report.report_number = t_report_detail.report_number
                    WHERE t_report.status_flag = 1 AND t_report.valid_flag = 1 AND t_report_detail.report2 != ""
                    GROUP BY t_staff.staff_code');
        if ($counts5) {
            foreach ($counts5 as $count5) {
                $existing_sum[$count5->staff_code] = $count5->cnt;
            }
        }else {
            $existing_sum = [];
        }

        //入校
        $counts6 = DB::select('SELECT t_staff.staff_code,count(*) AS cnt FROM t_staff 
                    JOIN t_report  ON t_staff.staff_code = t_report.staff_code
                    JOIN t_report_detail ON t_report.report_number = t_report_detail.report_number
                    WHERE t_report.status_flag = 1 AND t_report.valid_flag = 1 AND t_report_detail.action_type = 1
                    GROUP BY t_staff.staff_code');
        if ($counts6) {
            foreach ($counts6 as $count6) {
                $meeting_sum[$count6->staff_code] = $count6->cnt;
            }
        }else {
            $meeting_sum = [];
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
            'tproposal_sum' => $tproposal_sum,
            'treport_detail_sum' => $treport_detail_sum,
            'new_sum' => $new_sum,
            'existing_sum' => $existing_sum,
            'meeting_sum' => $meeting_sum,
        ];
        
    	return view('totalsales_result', $data);
    }
}
