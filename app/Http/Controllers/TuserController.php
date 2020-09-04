<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tuser;
use App\Tlogin;
use App\Tstaff;
use App\Tbranch;
use App\Tnotice;
use App\Http\Requests\loginFormRequest;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use DB;


class TuserController extends Controller
{

    /**
     * ログイン処理
     * @param  loginFormRequest $request Userid, Password
     * @return [type]           [description]
     */
    public function login(loginFormRequest $request) {

        $user_record = Tuser::where('user_id', $request->user_id)->where('valid_flag', 1)->first();
        // ユーザーアカウントの有効・無効
        if ( empty($user_record) ) {
                return redirect()->back()->with('flash_message', 'ユーザー名、またはパスワードが間違っています。');
        }

        if( $request->login_password == $user_record->login_password ){
            // 認証失敗許諾回数をリセット　 　最初に取得した初期値で上書き更新
            if( $user_record->allow_login_counts != 5 ){

                Tuser::where('user_id', $user_id)->where('valid_flag', 1)->update(['allow_login_counts' => 5]);
                
            }
            // ログインの記録
            $login_info = new Tlogin();
            $login_info->login_flag = 1;
            $login_info->login_datetime = Carbon::now();
            $login_info->login_user_id = $user_record->user_id;
            $login_info->login_location = $request->location;
            $login_info->save();

            // スタッフマスタのチェック
            // ユーザーID（t_users/assignd_staff_code）からスタッフ有無チェック（t_staff/staff_code）
            $staff = Tstaff::where('staff_code', $user_record->assigned_staff_code)->first();
            
            // レコードが無い場合, valid_flag=0 の場合「スタッフの登録がない、または無効になっています」
            if ( empty($staff) || $staff->valid_flag == 0 ) {
                return redirect()->back()->with('flash_message', 'スタッフの登録がない、または無効になっています。');
            }

            $request->session()->put('user_id', $user_record->user_id);

            return redirect('/top');
        
        } else {
            // パスワードの照合 不一致の場合
            if($user_record->allow_login_counts == 0){
                Tuser::where('user_id', $user_record->user_id)->where('valid_flag', 1)->update(['valid_flag' => 0]);
                return redirect()->back()->with('flash_message', 'アカウントがロックされました。管理者に確認してください。');
            } else {
                Tuser::where('user_id', $user_record->user_id)->where('valid_flag', 1)->decrement('allow_login_counts');
            }

            return redirect()->back()->with('flash_message', 'パスワードが間違っています');
        }
    }


    /**
     * login後　TOPページ
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function topPage(Request $request)
    {
        // notice 取得
        $notice = Tnotice::first();
        // $array_line = explode("\n", $notice->notice);
        // $array = array_map('trim', $array_line);
        // $title = $array_line[0];
        // unset($array[0]);
        // $content = implode("\n", $array);

        // 日付を整形
        $date = Carbon::parse($notice->updated_datetime)->isoFormat('YYYY年MM月DD日(ddd)');

        // 一週間前のものかどうかを判定
        $one_week_before = Carbon::now()->subWeek(1);
        if ( $one_week_before->gte(Carbon::parse($notice->updated_datetime)) ) {
            $red = 1;
        } else {
            $red = 0;
        }

        // スタッフ氏名と営業所名の取得と表示
        $data = [
            'staff_name' => $request->staff_name,
            'branch_name' => $request->branch_name,
            'authority_flag' => $request->authority_flag,
            // 'title' => $title,
            // 'content' => $content,
            'content' => $notice,
            'content_update' => $date,
            'red' => $red,
        ];

        return view('info', $data);
    }


    public function updateContent(Request $request)
    {
        $user_record = Tuser::where('user_id', $request->session()->get('user_id'))->where('valid_flag', 1)->first();
        $staff = Tstaff::where('staff_code', $user_record->assigned_staff_code)->first(); 
        $staff_code = (int)$staff->staff_code;
        $content = $request->title . $request->content;
        $update_data = [
            'notice' => $content,
            'updated_staff_code' => $staff_code,
            'updated_datetime' => Carbon::now(),
        ];
        DB::table('t_notice')->update($update_data);
        return redirect('/top');
    }

    /**
     * ログアウト処理
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function logout(Request $request)
    {

        $user_id = $request->session()->get('user_id');
        var_dump($user_id);
        $logout = new Tlogin();
        $logout->login_flag = 2;
        // $logout->login_datetime = date('Y-m-d H:i:s', strtotime('0000-00-00 00:00:00'));
        $logout->login_datetime = Carbon::parse('0')->toDateTimeString();
        $logout->logout_datetime = Carbon::now();
        $logout->login_user_id = $user_id;
        $logout->logout_location = $request->location;
        $logout->save();

        // $login = Tlogin::where('login_user_id', $user_id)->update([
        //     'login_flag' => 2
        // ]);
        // ログインページを表示　※ユーザー名、パスワード欄を消去
        // return redirect('/')->with('logout', 'logout');
        return redirect('/');
    }

}
