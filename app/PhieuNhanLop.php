<?php

namespace App;

use DataTables, Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\GiaSu, App\PhieuMoLop;
use Illuminate\Http\Request;

class PhieuNhanLop extends Model
{
    protected $table = 'phieu_nhan_lop';
    protected $fillable = ['lop', 'giasu', 'thoigianday', 'ghichu', 'trangthai'];

    public function phieu_mo_lop()
    {
        return $this->belongsTo(PhieuMoLop::class);
    }

    public function gia_su()
    {
        return $this->belongsTo(GiaSu::class);
    }

    public static function laythongtin_nhanday(Request $request)
    {
        $data = PhieuNhanLop::where('lop', $request->malop)
            ->leftJoin('phieu_mo_lop', 'phieu_nhan_lop.lop', '=', 'phieu_mo_lop.malop')
            ->leftJoin('gia_su', 'phieu_nhan_lop.giasu', '=', 'gia_su.id')
            ->select(['gia_su.id as giasu_id', 'gia_su.holot', 'gia_su.ten', 'gia_su.email', 'gia_su.sdt', 'gia_su.diachi as giasu_diachi', 'gia_su.trinhdo',
                'phieu_mo_lop.id as phieumolop_id', 'phieu_mo_lop.lopday', 'phieu_mo_lop.monday', 'phieu_mo_lop.loailop', 'phieu_mo_lop.diachi', 'phieu_mo_lop.sobuoihoc', 'phieu_mo_lop.thoigianhoc', 'phieu_mo_lop.thongtin', 'phieu_mo_lop.yeucau',
                'phieu_nhan_lop.id', 'phieu_nhan_lop.lop', 'phieu_nhan_lop.thoigianday', 'phieu_nhan_lop.ghichu', 'phieu_nhan_lop.trangthai'])
            ->get();

        return Datatables::of($data)
            ->editColumn('id', function($item){
                return '<button class="btn-id" style="margin-top:50px !important;">' . $item->id. '</button>';
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
                    <p style="color:red;"><b>Yêu cầu:</b> ' .$item->yeucau.'</p>
                    <p><b>Địa chỉ:</b> <a onclick="window.open(\'https://www.google.com/maps/place/' . urlencode($item->diachi) . '\')" title="Bấm vào đây để xem bản đồ">' . $item->diachi . '</a></p>';
            })

            ->addColumn('giasu', function ($item) {
                return '
                    <p><b>ID:</b> ' .$item->giasu_id.'</p>
                    <p><b>Họ tên:</b> ' .$item->holot. ' ' . $item->ten.'</p>
                    <p><b>Trình độ:</b> ' .$item->trinhdo.'</p>
                    <p><b>Email:</b><a href="mailto:' . $item->email . '" title="Bấm vào đây để gửi email">' . $item->email . '</a></p>
                    <p><b>SĐT:</b><a href="tel:' . $item->sdt . '" title="Bấm vào đây để gọi">' . $item->sdt . '</a></p>
                    <p><b>Địa chỉ:</b> <a onclick="window.open(\'https://www.google.com/maps/place/' . urlencode($item->giasu_diachi) . '\')" title="Bấm vào đây để xem bản đồ">' . $item->giasu_diachi . '</a></p>';
            })

            ->addColumn('thoigian', function ($item) {
                return '
                    <p><b>Số buổi học:</b> ' .$item->sobuoihoc.' ngày/tuần</p>
                    <p><b>Thời gian học:</b> ' .$item->thoigianhoc.'</p>
                    <p><b>Người học:</b> ' .$item->thongtin.'</p>
                    <p style="color:red;"><b>Bắt đầu dạy:</b> ' .Carbon::parse($item->thoigianday)->format('d-m-Y').'</p>
                    <p><b>Ghi chú:</b> ' .$item->ghichu.'</p>';
            })

            ->editColumn('trangthai', function ($item) {
                if ($item->trangthai == 0)
                    $trangthai = '<span class="label label-sm block status_0">CHỜ DUYỆT</span>';
                if ($item->trangthai == 1)
                    $trangthai = '<span class="label label-sm block status_1">ĐỦ ĐK</span>';
                if ($item->trangthai == 2)
                    $trangthai = '<span class="label label-sm block status_2">ĐANG DẠY</span>';
                if ($item->trangthai == 3)
                    $trangthai = '<span class="label label-sm block status_3">ĐÃ DẠY</span>';
                if ($item->trangthai == 4)
                    $trangthai = '<span class="label label-sm block status_4">NGƯNG DẠY</span>';
                if ($item->trangthai == 5)
                    $trangthai = '<span class="label label-sm block status_4">KHÔNG ĐẠT</span>';

                return '<p style="line-height:2; text-align:center; margin-top:10px;">' . $trangthai . '
                    <br><button type="button" id="trangthai" value="'.$item->id.'" data-molop="'.$item->phieumolop_id.'" class="btn btn-xs btn-block btn-info" data-toggle="modal" data-target="#div_trangthai"><i class="fal fa-repeat-alt"></i> Đổi TT</button>
                    <br><button type="button" id="edit" value="'.$item->id.'" class="btn btn-xs btn-block btn-warning" data-toggle="modal" data-target="#div_chinhsua"><i class="fal fa-edit"></i> Đổi GS</button>
                    <br><button type="button" id="remove" value="'.$item->id.'" class="btn btn-xs btn-block btn-danger"><i class="fal fa-trash-alt"></i> Xoá</button>
                    </p>';
            })

            ->rawColumns(['id', 'thongtin', 'giasu', 'thoigian', 'trangthai'])
            ->make(true);
    }
}
