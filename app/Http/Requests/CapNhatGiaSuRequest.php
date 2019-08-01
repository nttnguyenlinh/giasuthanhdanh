<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CapNhatGiaSuRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
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
