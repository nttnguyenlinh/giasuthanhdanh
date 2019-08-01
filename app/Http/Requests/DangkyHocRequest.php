<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DangkyHocRequest extends FormRequest
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
            'frmhoten' => 'required|string|max:30',
            'frmdiachi' => 'required|string|max:50',

            'frmsdt' => [
                'required',
                'regex:/^(03[2|3|4|5|6|7|8|9]|05[6|8|9]|07[0|6|7|8|9]|08[1|2|3|4|5|6|8|9]|09[0|1|2|3|4|6|7|8|9])+([0-9]{7})$/'
            ],
            'frmlophoc' => 'required',
            'frmmonhoc' => 'required|string|max:50',
            'frmloailop' => 'required|numeric',
            'frmsobuoihoc' => 'required|numeric',
            'frmyeucau' => 'required|string',
            'frmthoigianhoc' => 'required|string|max:30',
        ];
    }

    public function messages()
    {
        return [
            'frmhoten.required' => 'Vui lòng nhập họ tên.',
            'frmhoten.string' => 'Họ tên không hợp lệ.',
            'frmhoten.max' => 'Họ và tên bạn quá dài.',

            'frmdiachi.required' => 'Vui lòng nhập địa chỉ.',
            'frmdiachi.string' => 'Địa chỉ không hợp lệ.',
            'frmdiachi.max' => 'Địa chỉ quá dài.',

            'frmsdt.required' => 'Vui lòng nhập số điện thoại',
            'frmsdt.regex' => 'Số điện thoại không hợp lệ.',

            'frmlophoc.required' => 'Vui lòng chọn lớp học.',

            'frmmonhoc.required' => 'Vui lòng nhập môn học.',
            'frmmonhoc.string' => 'Môn học không hợp lệ.',
            'frmmonhoc.max' => 'Môn học quá nhiều.',

            'frmloailop.required' => 'Vui lòng chọn loại lớp học.',
            'frmloailop.numeric' => 'Loại lớp học không hợp lệ.',

            'frmsobuoihoc.required' => 'Vui lòng chọn số buổi học.',
            'frmsobuoihoc.numeric' => 'Số buổi học không hợp lệ',

            'frmyeucau.required' => 'Vui lòng chọn người dạy.',
            'frmyeucau.string' => 'Yêu cầu không hợp lệ.',

            'frmthoigianhoc.required' => 'Vui lòng chọn thời gian học.',
            'frmthoigianhoc.string' => 'Nội dung không hợp lệ.',
            'frmthoigianhoc.max' => 'Nội dung quá dài.',
        ];
    }
}
