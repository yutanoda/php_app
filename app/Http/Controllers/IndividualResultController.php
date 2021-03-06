<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Treport;
use App\Treportdetail;
use App\Tschool;
use App\Tsalesresult;
use App\Tstaff;
use App\Tcommon;
// composer require nesbot/carbon
use Carbon\Carbon;
use DB;
use App\Http\Requests\ReportFormRequest;


class IndividualResultController extends Controller
{

    /**
     * 個別報告書　初期表示
     * @param Request $request [description]
     */
    public function Index(Request $request)
    {
        //　タイトル条件 
        $title_commons = Tcommon::where('valid_flag', 1)
        ->where('common_id', 'report_title')
        ->get(['value1', 'common_number']);
                // 1ページあたりの表示件数取得
        $displayed_results = Tcommon::where('common_id', 'max_page_record')->first(['value1']);
        // 学校名
        $search_school = Tschool::where('assigned_staff_code', $request->staff_code)
        ->orderBy('school_name', 'asc')
        ->get(['school_code', 'school_name']);
        //　キーワード条件
        $commons_cate = Tcommon::where('common_id', 'keyword')->groupBy('value1')->get(['value1']);
        foreach ($commons_cate as $key => $value) {
            $collem[$value['value1']] = Tcommon::where('value1', $value['value1'])->get(['value2'])->toArray();
        }


        // 検索部分
        $reports = DB::table('t_report')->where('t_report.staff_code', $request->staff_code)
                ->where('valid_flag', 1);
        if ( $request->keyword_school || $request->keyword_title) {
        
            if ( $request->keyword_school || $request->keyword_title) {
        
                if ( $request->keyword_school ){
                    // 学校検索
                    $reports_front = Treportdetail::where('school_code', $request->keyword_school)
                    ->get(['report_number']);
                    $reports->whereIn('report_number', $reports_front);        

                }

                if( $request->keyword_title ){
                    // タイトル検索
                    if ( $request->keyword_title == 1 ){
                        $reports_front2 = Treportdetail::where('report1', '!=', '')
                        ->get(['report_number']);
                        $reports->whereIn('report_number', $reports_front2);
                    } elseif ( $request->keyword_title == 2 ) {
                        $reports_front2 = Treportdetail::where('report2', '!=', '')
                        ->get(['report_number']);
                        $reports->whereIn('report_number', $reports_front2);
                    }
                }
            }
        }
    
        // 日付検索
        if($request->keyword_date){
            $reports->where('submitted_datetime', 'like', $request->keyword_date .'%');
        }
        
        // キーワード検索
        if ( $request->keywords ) {

            $reports_front = [];
            foreach ($request->keywords as $key => $value) {
                $reports_front1 = Treportdetail::orWhere('report1', 'like','%' . $value . '%')
                ->orWhere('report2', 'like', '%' . $value . '%')
                ->orWhere('comment', 'like', '%' . $value . '%')
                ->get(['report_number'])
                ->toArray();
                $reports_front = array_merge($reports_front, $reports_front1);
            }
            foreach ($request->keywords as $key => $value) {
                $reports_front2 = Treport::orWhere('total_evaluation', 'like', '%' . $value . '%')
                ->orWhere('next_action', 'like', '%' . $value . '%')
                ->orWhere('comment', 'like', '%' . $value . '%')
                ->get(['report_number'])
                ->toArray();
                $reports_front = array_merge($reports_front, $reports_front2);
            }
            $reports->whereIn('report_number', $reports_front);
        }
        
        $reports = $reports->orderBy('submitted_datetime', 'DESC')
                    ->paginate($displayed_results->value1);

        if ($reports->isEmpty()) {
            $message = '該当する報告書がありません。';
            $school_name = null;
            $report_title = null;
        }else{
            $message = null;
            // 学校取得
            foreach ($reports as $key => $value) {
                $school_name[$value->report_number] = DB::table('t_report_detail')
                    ->select('school_name')
                    ->leftjoin('t_school', 't_report_detail.school_code', '=', 't_school.school_code')
                    ->where('report_number', $value->report_number)
                    ->get();
                // 時刻変換
                $value->submitted_datetime = date_format(date_create($value->submitted_datetime), 'Y/m/d');
                // 0埋め
                if ( strlen($value->report_number) == 1) {
                   $value->report_number = str_pad((string)$value->report_number, 6, 0, STR_PAD_LEFT);
                }
                if ( strlen($value->report_number) == 2) {
                   $value->report_number = str_pad((string)$value->report_number, 5, 0, STR_PAD_LEFT);
                }
                if ( strlen($value->report_number) == 3) {
                   $value->report_number = str_pad((string)$value->report_number, 4, 0, STR_PAD_LEFT);
                } 
                if ( strlen($value->report_number) == 4) {
                   $value->report_number = str_pad((string)$value->report_number, 3, 0, STR_PAD_LEFT);
                } 
                if ( strlen($value->report_number) == 5) {
                   $value->report_number = str_pad((string)$value->report_number, 2, 0, STR_PAD_LEFT);
                }
                if ( strlen($value->report_number) == 6) {
                   $value->report_number = str_pad((string)$value->report_number, 1, 0, STR_PAD_LEFT);
                } 
            }
            // 内容
            foreach ($reports as $key => $value) {
                $report_title[(integer)$value->report_number] = Treportdetail::leftjoin('t_common AS c', 't_report_detail.report_title1', '=', 'c.common_number')
                ->leftjoin('t_common AS c2', 't_report_detail.report_title2', '=', 'c2.common_number')
                ->where('t_report_detail.report_number', (integer)$value->report_number)
                ->where('c.common_id', 'report_title')
                ->where('c2.common_id', 'report_title')
                ->first([
                    'report_number', 
                    'report1 AS 1report', 
                    'report2 AS 2report', 
                    'c.value1 AS 1report_title', 
                    'c2.value1 AS 2report_title',
                    'comment',
                ]);
            }
        }


        // 検索結果を保持
        $request->session()->flash('keyword_school', $request->keyword_school);
        $request->session()->flash('keyword_title', $request->keyword_title);
        $request->session()->flash('keyword_date', $request->keyword_date);
        if ( is_array($request->keywords) ) {
            $keywords = implode($request->keywords, ',');
        }else{
            $keywords = null;
        }
        $request->session()->flash('keywords', $keywords);

        $data = [
            'staff_name' => $request->staff_name,
            'branch_name' => $request->branch_name,
            'authority_flag' => $request->authority_flag,
            'school_name' => $school_name,
            'reports' => $reports,
            'report_title' => $report_title,
            'message' => $message,
            //検索プルダウン
            'title_commons' => $title_commons,
            'search_school' => $search_school,
            'value1_arrays'=> $collem,
        ];

        return response(view('individual_result', $data))
            ->withHeaders([
                'Cache-Control' => 'no-store',
            ]);
    }

    /**
     * 報告書新規作成
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function create_report(Request $request)
    {
        //　報告書ヘッダーレコード（t_report）及び報告書明細レコード１件（t_report_detail）を作成
        $t_report_latest = Treport::max('report_number');

        $t_report = new Treport();
        
        if ( $t_report_latest === null ) {
        
            $t_report->report_number = 1;
        
        } else {

            $t_report->report_number = $t_report_latest + 1;
        
        }

        $t_report->valid_flag = 1;
        $t_report->staff_code = $request->staff_code;
        $t_report->branch_code = $request->branch_code;
        $t_report->created_datetime = Carbon::now();
        $t_report->update_datetime = Carbon::now();
        // $t_report->update_datetime = null;
        $t_report->submitted_datetime = null;
        $t_report->comment_datetime = null;
        $t_report->status_flag = 0;
        $t_report->save();
        $redirect_id = $t_report->id;
        $t_report = Treport::where('report_number', $redirect_id)->first();

        $t_report_detail = new Treportdetail();

        if ( $t_report_latest === null ) {
            
            $t_report_detail->report_number = 1;
        
        } else {

            $t_report_detail->report_number = $t_report_latest + 1;
        
        }
        $t_report_detail->detail_number = 1;
        $t_report_detail->created_datetime = Carbon::now();
        $t_report_detail->updated_datetime = Carbon::now();
        $t_report_detail->action_date = Carbon::now();
        $t_report_detail->school_code = 0;
        $t_report_detail->note = null;
        $t_report_detail->comment_datetime = null;
        $t_report_detail->save();

        return redirect(route('detail_report', ['report_number' => $redirect_id]));
    }


    /**
     * 報告書作成画面
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function detail_report(Request $request)
    {
        // 報告書の一覧表示
        if( strpos($request->headers->get('referer'), 'inclusion_result') ){
            $control = 1; // 全社報告書
        } else {
            if (session('control')){
                $control = session('control');
                $request->session()->forget('control');
            } else {
                $control = 2;
            }
        }

        if (session('return_num')){
            $return_num = session('return_num');
        } else {
            $return_num = 0;
        }


        // ヘッダー・フッター部分
        $t_report = Treport::where('valid_flag', 1)
                    ->where('report_number', $request->report_number)->first();
        $common = Tcommon::where('common_id', 'action_type')->where('valid_flag', 1)->get();

        $t_report_detail = Treportdetail::leftjoin('t_school as s', 't_report_detail.school_code', '=', 's.school_code')
                            ->leftjoin('t_prefecture AS tp', 's.prefecture_code', '=', 'tp.prefecture_code')
                            ->where('t_report_detail.report_number', $t_report->report_number)
                            ->get([
                                't_report_detail.detail_number',
                                't_report_detail.action_date',
                                't_report_detail.action_type',
                                's.school_name AS school_name',
                                's.school_code AS school_code',
                                's.school_rank AS school_rank',
                                's.number_of_students AS number_of_students',
                                's.school_rank AS school_rank',
                                'tp.prefecture_name',
                                's.address',
                                't_report_detail.note AS note',
                                't_report_detail.report1',
                                't_report_detail.report2',
                                't_report_detail.comment',
                                't_report_detail.report_category',
                            ]);


        // 実績
        $school_code_array = [];
        $school_rank = [];
        $sum = [];
        $test = 0;

        if ( $t_report_detail->isEmpty() ) {
            $performance = null;
        } else {
            foreach ($t_report_detail as $key => $value) {
                $year = date('Y') -1;
                $performance[$value->detail_number] = Tsalesresult::where('school_code', $value->school_code)
                                ->where('sale_date', '>=',  $year.'-09-01' )
                                ->get([
                                    'sale_date',
                                    'item_name',
                                    'sale_quantity',
                                    'grade',
                                    'sales_amount',
                                ]);
                if ( $value->school_code ) {
                    array_push($school_code_array, $value->school_code);
                    $sum[$value->detail_number] = Tsalesresult::where('school_code', $value->school_code)
                                ->where('sale_date', '>=',  $year.'-09-01' )
                                ->orderBy('sale_date', 'asc')
                                ->sum('sales_amount');
                }
                if ( $value->school_rank || $value->school_rank === 0) {
                    $school_rank[$value->detail_number] = Tcommon::where('common_id', 'school_rank')
                    ->where('common_number', $value->school_rank)
                    ->first(['value1'])->toArray();
                }
            }
        }

        // 分類
        $report_category = Tcommon::where('valid_flag', 1)->where('common_id', 'report_category')->get();
        $footer_report_category = Tcommon::where('valid_flag', 1)->where('common_id', 'report_category')->get();
        $t_staff = Tstaff::where('staff_code', $t_report->staff_code)->first();
        $school = Tschool::where('assigned_staff_code', $t_staff->staff_code)->orderBy('school_name', 'asc')->get(); 

        $data = [
            'control' => $control,
            'return_num' => $return_num,
            'staff_name' => $request->staff_name,
            'branch_name' => $request->branch_name,
            'authority_flag' => $request->authority_flag,
            'report_number' => $request->report_number,
            'staff_type' => $request->staff_type,

            't_report' => $t_report,
            't_staff' => $t_staff,

            't_report_detail' => $t_report_detail,
            'action_type' => $common,
            'schools' => $school,
            'performance' => $performance,
            'sum' => $sum,
            'report_category' => $report_category,
            'footer_report_category' => $footer_report_category,
            'school_rank' => $school_rank,
        ];

        return response(view('report', $data))
            ->withHeaders([
                'Cache-Control' => 'no-store',
            ]);
    
    }


    /**
     * 報告書登録・更新　ヘッダー機能
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function register(ReportFormRequest $request)
    {        
        // 提出ボタン押下
        switch ($request->register) {
            case 'register':
                Treport::where('report_number', $request->request_id)
                        ->update(
                            [
                                'status_flag'=>1, 
                                'submitted_datetime'=>Carbon::now(),
                            ]
                        );
                return redirect('individual_result');
                break;
            case 'delete':
                Treport::where('report_number', $request->request_id)->delete();
                Treportdetail::where('report_number', $request->request_id)->delete();
                return redirect('individual_result');
                break;
            case 'add':
                Treport::where('report_number', $request->request_id)
                        ->update(
                            [
                                'update_datetime'=>Carbon::now(),
                            ]
                        );
                // max
                $max_detail_number = Treportdetail::where('report_number', $request->request_id)->max('detail_number');
                $t_report_detail = new Treportdetail();
                $t_report_detail->report_number = $request->request_id;
                if ( $max_detail_number === null ) {
                    $t_report_detail->detail_number = 1;
                } else {
                    $t_report_detail->detail_number = $max_detail_number + 1;
                }
                $t_report_detail->created_datetime = Carbon::now();
                $t_report_detail->updated_datetime = null;
                $t_report_detail->action_date = Carbon::now();
                $t_report_detail->school_code = 0;
                $t_report_detail->note = null;
                $t_report_detail->comment_datetime = null;
                $t_report_detail->save();
                return redirect(route('detail_report', ['report_number' => $request->request_id]))
                    ->with('return_num', $request->return_num + 1);
                break;
            case 'update_footer':
                if ( $request->comment && $request->report_category) {
                    Treport::where('report_number', $request->request_id)
                    ->update(
                        [
                            'total_evaluation' => $request->total_evaluation,
                            'next_action' => $request->next_action,
                            'update_datetime'=>Carbon::now(),
                            'comment' => $request->comment,
                            'comment_datetime' => Carbon::now(),
                            'comment_staff_code' => $request->staff_code,
                            'report_category' => $request->report_category,
                        ]
                    );

                } elseif($request->comment) {
                    Treport::where('report_number', $request->request_id)
                    ->update(
                        [
                            'total_evaluation' => $request->total_evaluation,
                            'next_action' => $request->next_action,
                            'update_datetime'=>Carbon::now(),
                            'comment' => $request->comment,
                            'comment_datetime' => Carbon::now(),
                            'comment_staff_code' => $request->staff_code,
                        ]
                    );
                } elseif($request->report_category) {
                    Treport::where('report_number', $request->request_id)
                    ->update(
                        [
                            'total_evaluation' => $request->total_evaluation,
                            'next_action' => $request->next_action,
                            'update_datetime'=>Carbon::now(),
                            'comment' => $request->comment,
                            'comment_datetime' => Carbon::now(),
                            'comment_staff_code' => $request->staff_code,
                            'report_category' => $request->report_category,
                        ]
                    );
                } else {
                    Treport::where('report_number', $request->request_id)
                    ->update(
                        [
                            'total_evaluation' => $request->total_evaluation,
                            'next_action' => $request->next_action,
                            'update_datetime'=>Carbon::now(),
                            'comment' => $request->comment,
                        ]
                    );
                }
                return redirect(route('detail_report', ['report_number' => $request->request_id]))
                        ->with('return_num', $request->return_num + 1)
                        ->with('control', $request->control);
                break;
            case 'detail_delete':
                Treportdetail::where('report_number', $request->request_id)
                    ->where('detail_number', $request->detail_id)->delete();
                return redirect(route('detail_report', ['report_number' => $request->request_id]))
                    ->with('return_num', $request->return_num + 1);
                break;
            case 'detail_update':
                if (!$request->category) {
                    $request->category = 0;
                }
                if ( $request->comment && $request->category) {
                    Treportdetail::where('report_number', $request->request_id)
                    ->where('detail_number', $request->detail_id)
                    ->update([
                        'action_date' => $request->action_date,
                        'action_type' => $request->action_type,
                        'school_code' => $request->school_code,
                        'note' => $request->note,
                        'report1' => $request->report1,
                        'report2' => $request->report2,
                        'comment' => $request->comment,
                        'comment_datetime' => Carbon::now(),
                        'comment_staff_code' => $request->staff_code,
                        'report_category' => $request->category,
                        'updated_datetime' => Carbon::now()
                    ]);

                } elseif ($request->comment) {
                    Treportdetail::where('report_number', $request->request_id)
                    ->where('detail_number', $request->detail_id)
                    ->update([
                        'action_date' => $request->action_date,
                        'action_type' => $request->action_type,
                        'school_code' => $request->school_code,
                        'note' => $request->note,
                        'report1' => $request->report1,
                        'report2' => $request->report2,
                        'comment' => $request->comment,
                        'comment_datetime' => Carbon::now(),
                        'comment_staff_code' => $request->staff_code,
                        'updated_datetime' => Carbon::now()
                    ]);

                } elseif ($request->category) {
                    Treportdetail::where('report_number', $request->request_id)
                    ->where('detail_number', $request->detail_id)
                    ->update([
                        'action_date' => $request->action_date,
                        'action_type' => $request->action_type,
                        'school_code' => $request->school_code,
                        'note' => $request->note,
                        'report1' => $request->report1,
                        'report2' => $request->report2,
                        'comment' => $request->comment,
                        'comment_datetime' => Carbon::now(),
                        'comment_staff_code' => $request->staff_code,
                        'report_category' => $request->category,
                        'updated_datetime' => Carbon::now()
                    ]);
                } else {
                    Treportdetail::where('report_number', $request->request_id)
                    ->where('detail_number', $request->detail_id)
                    ->update([
                        'action_date' => $request->action_date,
                        'action_type' => $request->action_type,
                        'school_code' => $request->school_code,
                        'note' => $request->note,
                        'report1' => $request->report1,
                        'report2' => $request->report2,
                        'comment' => $request->comment,
                        'updated_datetime' => Carbon::now()
                    ]);
                }
                return redirect(route('detail_report', ['report_number' => $request->request_id]))
                    ->with('return_num', $request->return_num + 1)
                    ->with('control', $request->control);
                break;
            default:
                break;
        }
    }

}
