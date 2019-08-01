<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DataTables, Carbon\Carbon;
class BaiViet extends Model
{
    protected $table = 'bai_viet';
    protected $fillable = ['tieude', 'slug', 'danhmuc', 'mota', 'noidung', 'anhbia', 'trangthai'];

    public static function ds_baiviet()
    {
        $data = BaiViet::query();

        return Datatables::of($data)
            ->editColumn('id', function($baiviet){
                return '<button class="btn-id" style="margin-top:10px !important;">' . $baiviet->id . '</button>';
            })
            ->editColumn('anhbia', function ($baiviet) {
                if (!empty($baiviet->anhbia)) {
                    return '<center><img style="margin-top:0px; width:50px; height:50px;" src="/storage/'.$baiviet->anhbia.'"/></center>';
                } else {
                    return '<center><img style="margin-top:0px; width:50px; height:50px;" src="/storage/no_image.jpg"/></center>';
                }
            })
            ->editColumn('danhmuc', function ($baiviet) {
                Switch($baiviet->danhmuc)
                {
                    case 1: $danhmuc = "Tin tức"; break;
                    case 2: $danhmuc = "Tài liệu"; break;
                    case 3: $danhmuc = "Nội quy"; break;
                    case 4: $danhmuc = "Học phí"; break;
                    case 5: $danhmuc = "Giới thiệu"; break;
                    case 6: $danhmuc = "Phụ huynh"; break;
                    case 7: $danhmuc = "Gia sư"; break;
                    case 8: $danhmuc = "Loại lớp"; break;
                    default: $danhmuc = "Liên hệ";
                }
                return '<p style="text-align:center; margin-top:10px;"><span class="badge badge-primary">'.$danhmuc.'</span></p>';

            })
            ->editColumn('trangthai', function ($baiviet) {
                if ($baiviet->trangthai == 1) {
                    return '<p style="text-align:center;">
                            <span>' . Carbon::parse($baiviet->created_at)->format('d-m-Y') . '</span>
                            <span class="badge badge-success">Công khai</span>
                        </p>';
                } else {
                    return '
                        <p style="text-align:center;">
                            <span>' . Carbon::parse($baiviet->created_at)->format('d-m-Y') . '</span>
                            <span class="badge badge-danger">Riêng tư</span>
                        </p>';
                }
            })
            ->addColumn('action', function ($baiviet) {
                if ($baiviet->xoa == 1) {
                    return '<div style="text-align:center;">
                                <div>
                                    <a href="bai-viet/xem/'. $baiviet->id.'" class="btn btn-xs btn-success"><i class="fal fa-eye"></i> Xem</a>
                                    <button type="button" id="remove" value="'.$baiviet->id.'" class="btn btn-xs btn-danger"><i class="fal fa-trash-alt"></i> Xoá</button>
                                </div>
                            </div>
                       ';
                } else {
                    return '
                            <div style="text-align:center;">
                                <div>
                                     <a href="bai-viet/xem/'. $baiviet->id.'" class="btn btn-xs btn-success"><i class="fal fa-eye"></i> Xem</a>
                                    <button type="button" id="remove" value="'.$baiviet->id.'" class="btn btn-xs btn-danger disabled"><i class="fal fa-trash-alt"></i> Xoá</button>
                                </div>
                            </div>
                    ';
                }
            })
            ->rawColumns(['id', 'anhbia', 'danhmuc', 'trangthai', 'action'])
            ->make(true);
    }
}
