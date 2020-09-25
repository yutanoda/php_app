<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReportFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'request_id' => 'required|numeric',
            // 'action_type' => 'required_if:register, detail_update|exists:t_common, common_id',
            // 'school_code' => 'required_if:register, detail_update|exists:t_school, school_code',
            // 'action_date' => 'required_if:register',
        ];
    }

    public function massages()
    {
        return [
            'request_id.required' => '報告書NOが不正です。一覧画面から再度選択してください。',
            'request_id.numeric' => '報告書NOは整数でなければいけません。',
            // 'action_type.required_if' => '営業日・種別・訪問校が正しいか確認してください。',
            // 'action_date.required_if' => '営業日・種別・訪問校が正しいか確認してください。',
            // 'school_code.required_if' => '営業日・種別・訪問校が正しいか確認してください。',
        ];
    }

}
