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
            // 営業所コード（t_staff/branch_code）から営業所マスタを検索し、営業所名をセット（t_branch/branch_name）
            $branch = Tbranch::where('branch_code', $staff->branch_code)->first();

            // notice 取得
            $notice = Tnotice::first();
            $array_line = explode("\n", $notice->notice);
            $array = array_map('trim', $array_line);
            $title = $array_line[0];
            unset($array[0]);
            $content = implode("\n", $array);

            // スタッフ氏名と営業所名の取得と表示
            $data = [
                'staff_name' => $staff->staff_name,
                'branch_name' => $branch->branch_name,
                'authority_flag' => $user_record->authority_flag,
                'title' => $title,
                'content' => $content,
                'content_update' => $notice->updated_datetime,
            ];

            $request->session()->put('user_id', $user_record->user_id);

            return view('info', $data);
        
        } else {
            // パスワードの照合
            if($user_record->allow_login_counts == 0){
                Tuser::where('user_id', $user_record->user_id)->where('valid_flag', 1)->update(['valid_flag' => 0]);
                return redirect()->back()->with('flash_message', 'アカウントがロックされました。管理者に確認してください。');
            } else {
                Tuser::where('user_id', $user_record->user_id)->where('valid_flag', 1)->decrement('allow_login_counts');
            }

            return redirect()->back()->with('flash_message', 'パスワードが間違っています');
        }
    }


    public function topPage(Request $request)
    {
        $user_record = Tuser::where('user_id', $request->session()->get('user_id'))->where('valid_flag', 1)->first();
        $staff = Tstaff::where('staff_code', $user_record->assigned_staff_code)->first(); 
        $branch = Tbranch::where('branch_code', $staff->branch_code)->first();
        // notice 取得
        $notice = Tnotice::first();
        $array_line = explode("\n", $notice->notice);
        $array = array_map('trim', $array_line);
        $title = $array_line[0];
        unset($array[0]);
        $content = implode("\n", $array);

        // スタッフ氏名と営業所名の取得と表示
        $data = [
            'staff_name' => $staff->staff_name,
            'branch_name' => $branch->branch_name,
            'authority_flag' => $user_record->authority_flag,
            'title' => $title,
            'content' => $content,
            'content_update' => $notice->updated_datetime,
        ];

        $request->session()->put('user_id', $user_record->user_id);

        return view('info', $data);
    }

    public function updateContent(Request $request)
    {
        $user_record = Tuser::where('user_id', $request->session()->get('user_id'))->where('valid_flag', 1)->first();
        $staff = Tstaff::where('staff_code', $user_record->assigned_staff_code)->first(); 
        $staff_code = (integer)$staff->staff_code;
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

        $user_id = $request->session()->pull('user_id');
        $login = Tlogin::where('login_user_id', $user_id)->update(['login_flag' => 2]);
        // ログインページを表示　※ユーザー名、パスワード欄を消去
        return redirect('/')->with('logout', 'logout');
    }

}
