<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DataTables, Carbon\Carbon;
use App\PhieuMoLop;
class PhieuDangKy extends Model
{
    protected $table = 'phieu_dang_ky';
    protected $fillable = ['hoten', 'diachi', 'email', 'sodt', 'lophoc',
        'monhoc', 'loailop', 'sohocsinh', 'hocluc', 'sobuoihoc', 'thoigianhoc', 'yeucau', 'yeucauthem', 'trangthai'];

    public function phieu_mo_lop()
    {
        return $this->hasOne(PhieuMoLop::class, 'madk', 'id');
    }

    public static function ds_dangky()
    {
        $data = PhieuDangKy::query();
        return Datatables::of($data)
            ->editColumn('id', function($item){
                return '<center><button type="button" class="btn-id" value="' . $item->id . '">' . $item->id . '</button></center>';
            })

            ->editColumn('hoten', function ($item) {
                return '<center>' . $item->hoten . '</center>';
            })

            ->addColumn('thongtinlienhe', function ($item) {
                return '<center style="font-weight:bold;">
                    <p><a target="_blank" href="tel:' . $item->sdt . '" title="Bấm vào đây để gọi">' . $item->sdt . '</a></p>
                    <p><a target="_blank" href="mailto:' . $item->email . '" title="Bấm vào đây để gửi email">' . $item->email . '</a></p>
                    <p><a onclick="window.open(\'https://www.google.com/maps/place/' . urlencode($item->diachi) . '\')" title="Bấm vào đây để xem bản đồ">' . $item->diachi . '</a></p>
                    </center>';
            })

            ->addColumn('thongtinlop', function ($item) {
                $loailop = '';
                switch($item->loailop)
                {
                    case 1: $loailop = 'Lớp thường'; break;
                    case 2: $loailop = 'Lớp chất lượng cao'; break;
                    default: $loailop = 'Lớp đảm bảo';
                }

                return '
                    <p><strong>Lớp: </strong> ' . $item->lophoc . '</p>
                    <p><strong>Môn: </strong> ' . $item->monhoc . '</p>
                    <p><strong>Loại lớp: </strong> ' . $loailop . '</p>
                    ';
            })

            ->addColumn('thongtinhocvien', function ($item) {
                return '
                    <p><strong>Số lượng: </strong> ' . $item->sohocsinh . '</p>
                    <p><strong>Học lực: </strong> ' . $item->hocluc . '</p>
                    ';
            })

            ->addColumn('thoigianhoc', function ($item) {
                return '
                    <p><strong>Số buổi học: </strong> ' . $item->sobuoihoc . 'buổi/tuần</p>
                    <p><strong>Giờ học: </strong> ' . $item->thoigianhoc . '</p>
                    ';
            })

            ->addColumn('yeucau', function ($item) {
                return '
                    <p><strong>Yêu cầu: </strong> ' . $item->yeucau . '</p>
                    <p><strong>Ghi chú: </strong> ' . $item->yeucauthem . '</p>
                    ';
            })

            ->editColumn('trangthai', function ($item) {
                if ($item->trangthai == 1) {
                    return '<div style="text-align:center;">
                            <p>Ngày Đăng ký</p>
                            <p>' . Carbon::parse($item->created_at)->format('d-m-Y') . '</p>
                            <span class="badge badge-success">Đã duyệt</span>
                        </div>';
                } else {
                    return '<div style="text-align:center;">
                            <p>Ngày Đăng ký</p>
                            <p>' . Carbon::parse($item->created_at)->format('d-m-Y') . '</p>
                            <span class="badge badge-danger">Chưa duyệt</span>
                        </div>';
                }
            })


            ->addColumn('action', function ($item) {
                if ($item->trangthai == 1) {
                    return '<div style="text-align:center; margin-top:30px;">
                                <div>
                                    <button type="button" id="molop" value="'.$item->id.'" class="btn btn-xs btn-success" disabled><i class="fal fa-upload"></i> Mở lớp</button>
                                    <button type="button" id="remove" value="'.$item->id.'" class="btn btn-xs btn-danger"><i class="fal fa-trash-alt"></i> Xoá</button>
                                </div>
                            </div>
                       ';
                } else {
                    return '
                            <div style="text-align:center; margin-top:30px;">
                                <div>
                                    <button id="molop" value="'.$item->id.'" class="btn btn-xs btn-success" data-toggle="modal" data-target="#div_xetduyet"><i class="fal fa-upload"></i> Mở lớp</button>
                                    <button id="remove" value="'.$item->id.'" class="btn btn-xs btn-danger"><i class="fal fa-trash-alt"></i> Xoá</button>
                                </div>
                            </div>
                    ';
                }
            })
            ->rawColumns(['id', 'hoten', 'thongtinlienhe', 'thongtinlop', 'thongtinhocvien', 'thoigianhoc', 'yeucau', 'trangthai', 'action'])
            ->make(true);
    }
}
