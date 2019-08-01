<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DangkyGiaSuRequest extends FormRequest
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
            'frmholot' => 'required|max:30',
            'frmten' => 'required|max:30',
            'frmngaysinh' => 'required|date',
            'frmgioitinh' => 'required|numeric',
            'frmnoisinh' => 'required|max:30',
            'frmtinhthanh' => 'required|max:30',
            'frmdiachi' => 'required|max:30',
            'frmquanhuyen' => 'required|max:30',
            'frmemail' => [
                'required',
                'email',
                'regex:/^[a-zA-Z0-9_\.%\+\-]+@[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,}$/',
                'unique:gia_su,email'
            ],
            'frmsdt' => [
                'required',
                'regex:/^(03[2|3|4|5|6|7|8|9]|05[6|8|9]|07[0|6|7|8|9]|08[1|2|3|4|5|6|8|9]|09[0|1|2|3|4|6|7|8|9])+([0-9]{7})$/',
                'unique:gia_su,sdt'
            ],
            'frmcmnd' => [
                'required',
                'regex:/^((?!(0))[0-9]{9,12})$/',
                'unique:gia_su,cmnd'
            ],

            'frmtruonghoc' => 'required',
            'frmnganhhoc' => 'required',
            'frmnamtn' => 'required|numeric',
            'frmtrinhdo' => 'required',
            'frmmonday' => 'required',
            'frmlopday' => 'required',
            'frmkhuvuc' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'frmholot.required' => 'Vui lòng nhập họ lót.',
            'frmholot.max' => 'Họ lót bạn quá dài.',

            'frmten.required' => 'Vui lòng nhập tên.',
            'frmten.max' => 'Tên bạn quá dài.',

            'frmngaysinh.required' => 'Vui lòng chọn ngày sinh.',
            'frmngaysinh.date' => 'Ngày không hợp lệ.',

            'frmgioitinh.required' => 'Vui lòng chọn giới tính.',
            'frmgioitinh.date' => 'Giới tính không hợp lệ.',

            'frmnoisinh.required' => 'Vui lòng nhập nơi sinh.',
            'frmnoisinh.max' => 'Nơi sinh quá dài.',

            'frmdiachi.required' => 'Vui lòng nhập địa chỉ.',
            'frmdiachi.max' => 'Địa chỉ quá dài.',

            'frmquanhuyen.required' => 'Vui lòng chọn quận huyện.',
            'frmquanhuyen.max' => 'Quận huyện quá dài.',

            'frmtinhthanh.required' => 'Vui lòng chọn tỉnh thành.',
            'frmtinhthanh.max' => 'Tỉnh thành quá dài.',

            'frmemail.required' => 'Vui lòng nhập email.',
            'frmemail.email' => 'Email không hợp lệ.',
            'frmemail.regex' => 'Email không hợp lệ.',
            'frmemail.unique' => 'Email đã tồn tại.',

            'frmsdt.required' => 'Vui lòng nhập số ĐT.',
            'frmsdt.regex' => 'Số ĐT không hợp lệ.',
            'frmsdt.unique' => 'Số ĐT đã tồn tại.',

            'frmcmnd.required' => 'Vui lòng nhập số CMND/CCCD.',
            'frmcmnd.regex' => 'Số CMND/CCCD không hợp lệ.',
            'frmcmnd.unique' => 'Số CMND/CCCD đã tồn tại.',

            'frmtruonghoc.required' => 'Vui lòng nhập trường học.',
            'frmnganhhoc.required' => 'Vui lòng nhập ngành học.',

            'frmnamtn.required' => 'Vui lòng chọn năm TN.',
            'frmnamtn.numeric' => 'Năm TN không hợp lệ.',

            'frmtrinhdo.required' => 'Vui lòng chọn trình độ.',

            'frmmonday.required' => 'Vui lòng chọn môn dạy.',

            'frmlopday.required' => 'Vui lòng chọn lớp dạy.',

            'frmkhuvuc.required' => 'Vui lòng chọn khu vực dạy.',
        ];
    }
}
