<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tuser;
use App\Tstaff;
use App\Treport;
use App\Tproposal;
use App\Tschool;
use App\Treportdetail;


class SalesTotalController extends Controller
{
    
     /**
     * 営業集計　初期表示
     * @param Request $request [description]
     */
    public function Index(Request $request)
    {
        $staffs = Tstaff::all();

        foreach ( $staffs as $staff ) {
            $staff_code = $staff->staff_code;

            //報告書数
            $t_report_sum[$staff_code] = Treport::where('staff_code', $staff_code)
                                                    ->where('valid_flag', 1)
                                                    ->where('status_flag', 1)
                                                    ->count();
            //要望書数
            $t_proposal_sum[$staff_code] = Tproposal::where('staff_code', $staff_code)
                                                    ->where('valid_flag', 1)
                                                    ->where('status_flag', 1)
                                                    ->count();

            $t_report_ids = Treport::where('staff_code', $staff_code)
                                ->where('valid_flag', 1)
                                ->where('status_flag', 1)
                                ->get(['report_number']);
            
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
        }

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
        ];
        
    	return view('totalsales_result', $data);
    }
}
