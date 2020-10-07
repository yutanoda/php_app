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
        //加算日（t_common/common_id=max_summary_spanの日数（value1）をプラスした日付）デフォルトで使う
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

        //開始日と終了日の差
        $diff = ($end_date->timestamp - $start_date->timestamp) / (60 * 60 * 24) + 1;

        //抽出するスタッフ
        if ($request->staff_type >= 3 ) {
            $staffs = Tstaff::where('staff_type', 1)->where('valid_flag', 1)->orderBy('staff_code', 'asc')->get();
        } else {
            $staffs = Tstaff::where('staff_code', $request->staff_code)->get();
        }

        //報告書数
        $counts1 = DB::select('SELECT t_staff.staff_code,count(*) AS cnt FROM t_staff JOIN t_report  ON t_staff.staff_code = t_report.staff_code
                                WHERE t_report.status_flag = 1 AND t_report.valid_flag = 1 AND t_report.submitted_datetime >="' . $start_date . '" AND t_report.submitted_datetime <="' . $end_date . '"GROUP BY t_staff.staff_code');
        if ($counts1) {
            foreach ($counts1 as $count1) {
                $treport_sum[$count1->staff_code] = $count1->cnt;
            }
        }else {
            $treport_sum = [];
        }

        //要望書数
        $counts2 = DB::select('SELECT t_staff.staff_code,count(*) AS cnt FROM t_staff JOIN t_proposal  ON t_staff.staff_code = t_proposal.staff_code
                                WHERE t_proposal.status_flag = 1 AND t_proposal.valid_flag = 1 AND t_proposal.submitted_datetime >="' . $start_date . '" AND t_proposal.submitted_datetime <="' . $end_date . '"GROUP BY t_staff.staff_code');
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
                    WHERE t_report.status_flag = 1 AND t_report.valid_flag = 1 AND t_report.submitted_datetime >="' . $start_date . '" AND t_report.submitted_datetime <="' . $end_date . '"GROUP BY t_staff.staff_code');
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
                    WHERE t_report.status_flag = 1 AND t_report.valid_flag = 1 AND t_report_detail.report1 != "" AND t_report.submitted_datetime >="' . $start_date . '" AND t_report.submitted_datetime <="' . $end_date . '"GROUP BY t_staff.staff_code');
        
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
                    WHERE t_report.status_flag = 1 AND t_report.valid_flag = 1 AND t_report_detail.report2 != "" AND t_report.submitted_datetime >="' . $start_date . '" AND t_report.submitted_datetime <="' . $end_date . '"GROUP BY t_staff.staff_code');
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
                    WHERE t_report.status_flag = 1 AND t_report.valid_flag = 1 AND t_report_detail.action_type = 1 AND t_report.submitted_datetime >="' . $start_date . '" AND t_report.submitted_datetime <="' . $end_date . '"GROUP BY t_staff.staff_code');
        if ($counts6) {
            foreach ($counts6 as $count6) {
                $meeting_sum[$count6->staff_code] = $count6->cnt;
            }
        }else {
            $meeting_sum = [];
        }
        //事務
        $counts7 = DB::select('SELECT t_staff.staff_code,count(*) AS cnt FROM t_staff 
                    JOIN t_report  ON t_staff.staff_code = t_report.staff_code
                    JOIN t_report_detail ON t_report.report_number = t_report_detail.report_number
                    WHERE t_report.status_flag = 1 AND t_report.valid_flag = 1 AND t_report_detail.action_type = 2 AND t_report.submitted_datetime >="' . $start_date . '" AND t_report.submitted_datetime <="' . $end_date . '"GROUP BY t_staff.staff_code');

        if ($counts7) {
            foreach ($counts7 as $count7) {
                $office_sum[$count7->staff_code] = $count7->cnt;
            }
        }else {
            $office_sum = [];
        }

        //アポ
        $counts8 = DB::select('SELECT t_staff.staff_code,count(*) AS cnt FROM t_staff 
                    JOIN t_report  ON t_staff.staff_code = t_report.staff_code
                    JOIN t_report_detail ON t_report.report_number = t_report_detail.report_number
                    WHERE t_report.status_flag = 1 AND t_report.valid_flag = 1 AND t_report_detail.action_type = 3 AND t_report.submitted_datetime >="' . $start_date . '" AND t_report.submitted_datetime <="' . $end_date . '"GROUP BY t_staff.staff_code');

        if ($counts8) {
            foreach ($counts8 as $count8) {
                $appointment_sum[$count8->staff_code] = $count8->cnt;
            }
        }else {
            $appointment_sum = [];
        }

        //預け
        $counts9 = DB::select('SELECT t_staff.staff_code,count(*) AS cnt FROM t_staff 
                    JOIN t_report  ON t_staff.staff_code = t_report.staff_code
                    JOIN t_report_detail ON t_report.report_number = t_report_detail.report_number
                    WHERE t_report.status_flag = 1 AND t_report.valid_flag = 1 AND t_report_detail.action_type = 4 AND t_report.submitted_datetime >="' . $start_date . '" AND t_report.submitted_datetime <="' . $end_date . '"GROUP BY t_staff.staff_code');

        if ($counts9) {
            foreach ($counts9 as $count9) {
                $depo_sum[$count9->staff_code] = $count9->cnt;
            }
        }else {
            $depo_sum = [];
        }

        //tel
        $counts10 = DB::select('SELECT t_staff.staff_code,count(*) AS cnt FROM t_staff 
                    JOIN t_report  ON t_staff.staff_code = t_report.staff_code
                    JOIN t_report_detail ON t_report.report_number = t_report_detail.report_number
                    WHERE t_report.status_flag = 1 AND t_report.valid_flag = 1 AND t_report_detail.action_type = 5 AND t_report.submitted_datetime >="' . $start_date . '" AND t_report.submitted_datetime <="' . $end_date . '"GROUP BY t_staff.staff_code');

        if ($counts10) {
            foreach ($counts10 as $count10) {
                $tel_sum[$count10->staff_code] = $count10->cnt;
            }
        }else {
            $tel_sum = [];
        }

        //メール
        $counts11 = DB::select('SELECT t_staff.staff_code,count(*) AS cnt FROM t_staff 
                    JOIN t_report  ON t_staff.staff_code = t_report.staff_code
                    JOIN t_report_detail ON t_report.report_number = t_report_detail.report_number
                    WHERE t_report.status_flag = 1 AND t_report.valid_flag = 1 AND t_report_detail.action_type = 6 AND t_report.submitted_datetime >="' . $start_date . '" AND t_report.submitted_datetime <="' . $end_date . '"GROUP BY t_staff.staff_code');

        if ($counts11) {
            foreach ($counts11 as $count11) {
                $mail_sum[$count11->staff_code] = $count11->cnt;
            }
        }else {
            $mail_sum = [];
        }

        //週ごとの営業校の集計
        
        $week = 1;
        while($diff > 0) {
            $week_start_date = $start_date->copy()->addDay(($week - 1) * 7);
            if ($diff <= 7) {
                $week_end_date = $end_date;
            } else {
                $week_end_date = $start_date->copy()->addDay($week * 7 - 1);
            }
            $counts12 = DB::select('SELECT t_staff.staff_code,count(*) AS cnt FROM t_staff 
            JOIN t_report  ON t_staff.staff_code = t_report.staff_code
            JOIN t_report_detail ON t_report.report_number = t_report_detail.report_number
            WHERE t_report.status_flag = 1 AND t_report.valid_flag = 1 AND t_report.submitted_datetime >="' . $week_start_date . '" AND t_report.submitted_datetime <="' . $week_end_date . '"GROUP BY t_staff.staff_code');

            foreach ($counts12 as $count12) {
                $week_sum[$count12->staff_code][$week] = $count12->cnt;
            }
        
            $diff = $diff - 7;
            $week++;
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
            'office_sum' => $office_sum,
            'appointment_sum' => $appointment_sum,
            'depo_sum' => $depo_sum,
            'tel_sum' => $tel_sum,
            'mail_sum' => $mail_sum,
            'week_sum' => $week_sum,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'add_day' => $add_day,
        ];
        
    	return view('totalsales_result', $data);
    }
}
