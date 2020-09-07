<?php

namespace App\Http\Middleware;

use Closure;
use App\Tuser;
use App\Tstaff;
use App\Tbranch;


class CommonData
{
    /**
     * header 表示用
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // 　処理
        if ( empty($request->session()->get('user_id')) ) {
            return redirect('/');
        }

        $user_record = Tuser::where('user_id', $request->session()->get('user_id'))->where('valid_flag', 1)->first();
        $staff = Tstaff::where('staff_code', $user_record->assigned_staff_code)->first(); 
        $branch = Tbranch::where('branch_code', $staff->branch_code)->first();
        // スタッフ氏名と営業所名の取得と表示
        $data = [
            'staff_name' => $staff->staff_name,
            'branch_name' => $branch->branch_name,
            'authority_flag' => $user_record->authority_flag,
            'staff_code' => $staff->staff_code,
            'branch_code' => $branch->branch_code,
            'staff_type' => $staff->staff_type,
        ];
        $request->merge($data);
        return $next($request);
      }
}
