<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tuser;
use App\Treport;
use App\Treportdetail;
use App\Tcommon;
use App\Tbranch;
use App\Tstaff;
use App\Tprefecture;
use App\Tschool;
use DB;


class InclusionResultController extends Controller
{
    /**
     * 全社報告書 初期表示
     * @param Request $request [description]
     */
    public function Index(Request $request)
    {

        // commonテーブルを取得
        $commons = Tcommon::where('common_id', 'keyword')->get(['value1', 'value2']);
        $commons_cate = Tcommon::where('common_id', 'keyword')->groupBy('value1')->get(['value1']);
        // 1ページあたりの表示件数取得
        $displayed_results = Tcommon::where('common_id', 'max_page_record')->first(['value1']);

        foreach ($commons_cate as $key => $value) {
            $collem[$value['value1']] = Tcommon::where('value1', $value['value1'])->get(['value2'])->toArray();
        }

        // プルダウン　タイトル条件
        $title_commons = Tcommon::where('valid_flag', 1)
            ->where('common_id', 'report_title')
            ->get(['value1', 'common_number']);
        // プルダウン　営業所条件
        $branch_commons = Tbranch::select('branch_name', 'branch_code')->where('valid_flag', 1)
            ->get();
        // プルダウン　提出者条件
        $submitter_commons = Tstaff::select('staff_name', 'staff_code')->where('valid_flag', 1)
            ->where('staff_type',1)
            ->get();
        // プルダウン　都道府県条件
        $prefecture_commons = Tprefecture::select('prefecture_name', 'prefecture_code')
            ->get();
        // プルダウン　学校条件
        $school_commons = Tschool::select('school_name', 'prefecture_code', 'school_code')
            ->get();
        // プルダウン　ランク条件
        $rank_commons = Tcommon::where('valid_flag', 1)
            ->where('common_id', 'school_rank')
            ->get(['value1', 'common_number']);
        // プルダウン　分類条件
        $category_commons = Tcommon::select('value1', 'common_number')->where('valid_flag', 1)
            ->where('common_id', 'report_category')
            ->get();

        // 検索部分
        $keyword_prefecture = $request->keyword_prefecture;
        $keywords = $request->keywords;

        $reports = Treport::where('valid_flag', 1)->where('status_flag', 1);
        // 日付検索
        if ( $request->keyword_date ) {
                if($keyword_date != ''){
                    $keyword_date = substr($keyword_date, 0, 4);
                    $reports->where('submitted_datetime', 'like', $keyword_date.'%');
                }
        }
        // タイトル・検索・ランク条件検索
        if ( $request->keyword_school || $request->keyword_title || $request->keyword_rank) {
        
            if ( $request->keyword_school ){
                // 学校検索
                $reports_front = Treportdetail::where('school_code', $request->keyword_school)
                ->get(['report_number']);
                $reports->whereIn('report_number', $reports_front);        

            }

            if( $request->keyword_title ){
                // タイトル検索
                $reports_front2 = Treportdetail::orWhere('report_title1', $request->keyword_title)
                ->orWhere('report_title2', $request->keyword_title)
                ->get(['report_number']);
                $reports->whereIn('report_number', $reports_front2);
            }

            if ( $request->keyword_rank ) {
                $school_code = Tschool::where('school_rank', $request->keyword_rank)->get(['school_code']);
                $report_number_school_code = Treportdetail::whereIn('school_code', $school_code)->get(['report_number']);
                $reports->whereIn('report_number', $report_number_school_code);
            }

        }
        // 営業所検索
        if( $request->keyword_branch ){
            $reports->where('branch_code',  $request->keyword_branch);
        }
        // 提出者検索
        if( $request->keyword_submitter ){
            $reports->where('staff_code', $request->keyword_submitter);
        }

        // 分類検索
        if ( $request->keyword_category ) {
            $detail_category = Treportdetail::leftjoin('t_report', 't_report_detail.report_number', '=', 't_report.report_number')
                ->where('t_report.report_category', $request->keyword_category)
                ->where('t_report_detail.report_category', $request->keyword_category)
                ->get(['t_report.report_number'])->toArray();
            $reports->whereIn('report_number', $detail_category);
        }

        // キーワード検索
        if ( $request->keywords ) {

            foreach ($request->keywords as $key => $value) {
                $reports_front = Treportdetail::orWhere('report1', 'like', $value. '%')
                ->orWhere('report2', 'like', $value. '%')
                ->orWhere('comment', 'like', $value. '%')
                ->get(['report_number'])
                ->toArray();
            }
            foreach ($request->keywords as $key => $value) {
                $reports_front2 = Treport::orWhere('total_evaluation', 'like', $value. '%')
                ->orWhere('next_action', 'like', $value. '%')
                ->orWhere('comment', 'like', $value. '%')
                ->get(['report_number'])
                ->toArray();
            }
            $reports_front = array_merge($reports_front, $reports_front2);
            $reports->whereIn('report_number', $reports_front);
        }

        $reports = $reports->orderBy('submitted_datetime', 'DESC')->paginate($displayed_results->value1);

        // レコードが0件の場合　エラーメッセージ
        if( $reports->first() ){
            $message = null;
            // 内容
            foreach ($reports as $key => $value) {
                $report_title[$value->report_number] = Treportdetail::leftjoin('t_common AS c', 't_report_detail.report_title1', '=', 'c.common_number')
                ->leftjoin('t_common AS c2', 't_report_detail.report_title2', '=', 'c2.common_number')
                ->where('report_number', $value->report_number)
                // ->where('c.common_id', 'report_title')
                ->first([
                    'report_number', 
                    'report1 AS 1report', 
                    'report2 AS 2report', 
                    'c.value1 AS 1report_title', 
                    'c2.value1 AS 2report_title',
                    'comment',
                ]);
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
        }else{
            $message = '該当する報告書がありません。';
            $report_title = null;
        }

        $data = [
            'message' => $message,
            //検索プルダウン
            'title_commons' => $title_commons,
            'branch_commons' => $branch_commons,
            'submitter_commons' => $submitter_commons,
            'prefecture_commons' => $prefecture_commons,
            'school_commons' => $school_commons,
            'rank_commons' => $rank_commons,
            'category_commons' => $category_commons,
            'commons' => $commons,
            //検索結果
            'reports' => $reports,
            'value1_arrays'=> $collem,
            'staff_name' => $request->staff_name,
            'branch_name' => $request->branch_name,
            'authority_flag' => $request->authority_flag,
            'report_title' => $report_title,
        ];

    	return view('inclusion_result', $data);
    }



}
