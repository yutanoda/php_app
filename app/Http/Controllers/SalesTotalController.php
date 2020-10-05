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
        $staffs = Tstaff::orderBy('staff_code', 'asc')->get();
        //$staffs = Tstaff::with('treports')->orderBy('staff_code', 'asc')->get();
       
        //加算日（t_common/common_id=max_summary_spanの日数（value1）をプラスした日付）
        $add_day = Tcommon::where('common_id', 'max_summary_span')->first(['value1'])['value1'];

        foreach ( $staffs as $staff ) {
            $staff_code = $staff->staff_code;

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
            
            //報告書数
            $t_report_sum[$staff_code] = $staff->treports()
                                            ->where('valid_flag', 1)
                                            ->where('status_flag', 1)
                                            ->where('submitted_datetime', '>=',  $start_date )
                                            ->where('submitted_datetime', '<=',  $end_date )
                                            ->count();
            //要望書数
            $t_proposal_sum[$staff_code] = $staff->tproposals()
                                                    ->where('valid_flag', 1)
                                                    ->where('status_flag', 1)
                                                    ->where('submitted_datetime', '>=',  $start_date )
                                                    ->where('submitted_datetime', '<=',  $end_date )
                                                    ->count();

            $t_report_ids = $staff->treports()
                                ->where('valid_flag', 1)
                                ->where('status_flag', 1)
                                ->where('submitted_datetime', '>=',  $start_date )
                                ->where('submitted_datetime', '<=',  $end_date )
                                ->get(['report_number'])
                                ->toArray();
            
            //ここをt_reportの子モデルの取り出しにできないか

            $t_report_detail = Treportdetail::whereIn('report_number', $t_report_ids);

            //営業校数(t_report_detailの合計)
            $t_report_detail_sum[$staff_code] = $t_report_detail->count();

            //新規数(記明細レコード件数からreport1（テキスト）がnullまたはブランクのレコードを除外した件数合計)
            $t_report_detail_new_sum[$staff_code] = Treportdetail::whereIn('report_number', $t_report_ids)
                                                        ->where('report1', '!=', '')
                                                        ->count();
            //継続数(上記明細レコード件数からreport2（テキスト）がnullまたはブランクのレコードを除外した件数合計)
            $t_report_detail_existing_sum[$staff_code] = Treportdetail::whereIn('report_number', $t_report_ids)
                                                            ->where('report2', '!=', '')
                                                            ->count();
            //入校(上記明細レコード件数の内、action_type=1の件数合計)
            $t_report_detail_meeting_sum[$staff_code] = Treportdetail::whereIn('report_number', $t_report_ids)
                                                            ->where('action_type', 1)
                                                            ->count();
            //事務(上記明細レコード件数の内、action_type=2の件数合計)
            $t_report_detail_office_sum[$staff_code] = Treportdetail::whereIn('report_number', $t_report_ids)
                                                            ->where('action_type', 2)
                                                            ->count();
            //アポ(上記明細レコード件数の内、action_type=3の件数合計)
            $t_report_detail_appointment_sum[$staff_code] = Treportdetail::whereIn('report_number', $t_report_ids)
                                                            ->where('action_type', 3)
                                                            ->count();
            //電話(上記明細レコード件数の内、action_type=4の件数合計)
            $t_report_detail_tel_sum[$staff_code] = Treportdetail::whereIn('report_number', $t_report_ids)
                                                            ->where('action_type', 4)
                                                            ->count();
            //メール(上記明細レコード件数の内、action_type=5の件数合計)
            $t_report_detail_mail_sum[$staff_code] = Treportdetail::whereIn('report_number', $t_report_ids)
                                                            ->where('action_type', 5)
                                                            ->count();
            
            //週ごとの校数
            $week = 1;
            while($diff > 0) {
                
                $week_start_date = $start_date->copy()->addDay(($week - 1) * 7);
                if ($diff < 7) {
                    $week_end_date = $end_date;
                } else {
                    $week_end_date = $start_date->copy()->addDay($week * 7 - 1);
                }
                
                $t_report_detail_week_sum[$staff_code][$week] = Treportdetail::whereIn('report_number', $t_report_ids)
                                                                    ->where('created_datetime', '>=',  $week_start_date )
                                                                    ->where('created_datetime', '<=',  $week_end_date )
                                                                    ->count();
                $diff = $diff - 7;
                $week++;
            }

        }
        //検索結果をsessionで保持

        $request->session()->flash('start_date', $request->start_date);
        $request->session()->flash('end_date', $request->end_date);

        $data = [
            'staff_name' => $request->staff_name,
            'branch_name' => $request->branch_name,
            'authority_flag' => $request->authority_flag,
            'staffs' => $staffs,
            't_report_sum' => $t_report_sum,
            't_proposal_sum' => $t_proposal_sum,
            't_report_detail_sum' => $t_report_detail_sum,
            't_report_detail_new_sum' => $t_report_detail_new_sum,
            't_report_detail_existing_sum' => $t_report_detail_existing_sum,
            't_report_detail_meeting_sum' => $t_report_detail_meeting_sum,
            't_report_detail_office_sum' => $t_report_detail_office_sum,
            't_report_detail_appointment_sum' => $t_report_detail_appointment_sum,
            't_report_detail_tel_sum' => $t_report_detail_tel_sum,
            't_report_detail_mail_sum' => $t_report_detail_mail_sum,
            'start_date' => $start_date,
            'end_date' => $end_date,
            't_report_detail_week_sum' => $t_report_detail_week_sum,
            'add_day' => $add_day,
        ];
        
    	return view('totalsales_result', $data);
    }
}
