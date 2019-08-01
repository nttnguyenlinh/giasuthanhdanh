<?php

namespace App;

use DataTables, Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\PhieuDangKy, App\PhieuNhanLop;
class PhieuMoLop extends Model
{
    protected $table = 'phieu_mo_lop';
    //protected $primaryKey = 'malop';
    protected $fillable = ['malop', 'slug', 'madk', 'lopday', 'monday', 'loailop', 'diachi',
        'luong', 'lephi', 'sobuoihoc', 'thoigianhoc', 'thongtin', 'yeucau', 'trangthai'];

    public function phieu_dang_ky()
    {
        return $this->belongsTo(PhieuDangKy::class);
    }

    public function phieu_nhan_lop()
    {
        return $this->hasMany(PhieuNhanLop::class, 'lop', 'malop');
    }

    public static function ds_lop()
    {
        $data = PhieuMoLop::leftJoin('phieu_dang_ky', 'phieu_mo_lop.madk', '=', 'phieu_dang_ky.id')
            ->select(['phieu_mo_lop.id', 'phieu_mo_lop.malop', 'phieu_dang_ky.id AS pdk_id', 'phieu_dang_ky.hoten', 'phieu_dang_ky.diachi AS pdk_diachi', 'phieu_dang_ky.email', 'phieu_dang_ky.sdt',
                'phieu_mo_lop.lopday', 'phieu_mo_lop.monday', 'phieu_mo_lop.loailop', 'phieu_mo_lop.diachi', 'phieu_mo_lop.luong', 'phieu_mo_lop.lephi',
                'phieu_mo_lop.sobuoihoc', 'phieu_mo_lop.thoigianhoc', 'phieu_mo_lop.thongtin', 'phieu_mo_lop.yeucau', 'phieu_mo_lop.trangthai', 'phieu_mo_lop.created_at'])
            ->get();

        return Datatables::of($data)
            ->editColumn('id', function($item){
                return '<button class="btn-cmnd" style="margin-top:50px !important;">' . $item->malop. '</button>';
            })

            ->addColumn('dangky', function ($item) {
                return '
                    <p><b>Mã đăng ký:</b> ' .$item->pdk_id.'</p>
                    <p><b>Họ tên:</b> ' .$item->hoten.'</p>
                    <p><b>Email:</b> ' .$item->email.'</p>
                    <p><b>Số ĐT:</b> ' .$item->sdt.'</p>
                    <p><b>Địa chỉ:</b> <a onclick="window.open(\'https://www.google.com/maps/place/' . urlencode($item->pdk_diachi) . '\')" title="Bấm vào đây để xem bản đồ">' . $item->pdk_diachi . '</a></p>';
            })

            ->addColumn('thongtin', function ($item) {
                $loailop = '';
                switch($item->loailop)
                {
                    case 1: $loailop = 'Lớp thường'; break;
                    case 2: $loailop = 'Lớp chất lượng cao'; break;
                    default: $loailop = 'Lớp đảm bảo';
                }

                return '
                    <p><b>Loại lớp:</b> ' .$loailop.'</p>
                    <p><b>Lớp:</b> ' .$item->lopday.'</p>
                    <p><b>Môn:</b> ' .$item->monday.'</p>
                    <p><b>Ngày mở:</b> '. Carbon::parse($item->created_at)->format('d-m-Y') . '</p>
                    <p><b>Địa chỉ:</b> <a onclick="window.open(\'https://www.google.com/maps/place/' . urlencode($item->diachi) . '\')" title="Bấm vào đây để xem bản đồ">' . $item->diachi . '</a></p>';
            })

            ->addColumn('chitiet', function ($item) {
                return '
                    <p><b>Số buổi học:</b> ' .$item->sobuoihoc.' ngày/tuần</p>
                    <p><b>Thời gian học:</b> ' .$item->thoigianhoc.'</p>
                    <p><b>Người học:</b> ' .$item->thongtin.'</p>';
            })

            ->addColumn('thanhtoan', function ($item) {
                return '
                    <p><b>Mức lương:</b> ' .number_format($item->luong,0,'','.'). '<sup>đ</sup>/tháng</p>
                    <p><b>Mức phí:</b> ' .$item->lephi.'%</p>
                    <p><b>Hoa hồng:</b> ' .number_format((((float)$item->luong * (float)$item->lephi)/100), 0, '', '.').'<sup>đ</sup>/tháng</p>';
            })

            ->editColumn('yeucau', function ($item) {
                return '<p style="margin-top:40px;">'.$item->yeucau.'</p>';
            })

            ->editColumn('trangthai', function ($item) {
                if ($item->trangthai == 1) {
                    return '
                    <p style="text-align:center; margin-top:40px;">
                        <input type="checkbox" class="simpleCheck switch simpleCheck-checked"/>
                    </p>';
                } else {
                    return '
                    <p style="text-align:center; margin-top:40px;">
                        <input type="checkbox" class="simpleCheck switch"/>
                    </p>';
                }
            })

            ->addColumn('action', function ($item) {
                return '<p style="line-height:2; text-align:center; margin-top:30px;">
                    <button type="button" id="trangthai" value="'.$item->id.'" data-status="'.$item->trangthai.'" class="btn btn-xs btn-info"><i class="fal fa-repeat-alt"></i> Đổi</button>
                    <br><button type="button" id="edit" value="'.$item->id.'" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#div_chinhsua"><i class="fal fa-edit"></i> Sửa</button>
                    <br><button type="button" id="remove" value="'.$item->id.'" class="btn btn-xs btn-danger"><i class="fal fa-trash-alt"></i> Xoá</button>
                    </p>';
            })
            ->rawColumns(['id', 'dangky', 'thongtin', 'chitiet', 'thanhtoan', 'yeucau', 'trangthai', 'action'])
            ->make(true);
    }
}
