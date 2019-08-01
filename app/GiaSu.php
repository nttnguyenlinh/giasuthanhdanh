<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\PasswordReset;
use DataTables, Carbon\Carbon;
use App\PhieuNhanLop;

class GiaSu extends Authenticatable
{
    use Notifiable;
    protected $table = 'gia_su';
    protected $fillable = [
        'holot', 'ten', 'ngaysinh', 'gioitinh', 'noisinh', 'cmnd', 'diachi', 'quanhuyen', 'tinhthanh',
        'email', 'sdt', 'password', 'truonghoc', 'nganhhoc', 'namtn', 'trinhdo', 'monday', 'lopday',
        'khuvucday', 'thongtinkhac', 'anhthe', 'anhcmnd', 'trangthai',
    ];

    protected $hidden = [
        'matkhau', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function phieu_nhan_lop()
    {
        return $this->hasMany(PhieuNhanLop::class, 'giasu', 'id');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordReset($token));
    }

    public static function ds_giasu()
    {
        $data = GiaSu::query();
        return Datatables::of($data)
            ->editColumn('cmnd', function($user){
                return '<center><button type="button" class="btn-cmnd" id="view" data-toggle="modal" data-target="#div_view" value="' . $user->id . '">' . $user->cmnd . '</button></center>';
            })

            ->editColumn('holot', function ($user) {
                return '<center>' . $user->holot . '</center>';
            })

            ->editColumn('ten', function ($user) {
                return '<center>' . $user->ten . '</center>';
            })

            ->editColumn('trangthai', function ($user) {
                if ($user->trangthai == 1) {
                    return '<center><span class="badge badge-success">Hoạt động</span></center>';
                } else {
                    return '<center><span class="badge badge-danger">Khoá</span></center>';
                }
            })

            ->editColumn('trinhdo', function ($user) {
                return '<center><span class="badge badge-purple">' . $user->trinhdo . '</span></center>';
            })

            ->editColumn('quanhuyen', function ($user) {
                return '<center><span class="badge badge-info">' . $user->quanhuyen . '</span></center>';
            })

            ->editColumn('khuvucday', function ($user) {
                $mang = array();
                foreach(\App\KhuVuc::all() as $i)
                    foreach(explode(",",$user->khuvucday) as $khuvuc)
                        if($khuvuc == $i->id)
                        {
                            $mang[] = $i->tenkv;
                        }
                return implode(', ',$mang);
            })

            ->editColumn('sdt', function ($user) {
                return '<center style="font-weight:bold;"><a href="tel:' . $user->sdt . '" title="Bấm vào đây để gọi">' . $user->sdt . '</a></center>';
            })

            ->editColumn('email', function ($user) {
                return '<center style="font-weight:bold;"><a href="mailto:' . $user->email . '" title="Bấm vào đây để gửi email">' . $user->email . '</a></center>';
            })

            ->addColumn('action', function ($user) {
                if ($user->trangthai == 1) {
                    return '<div style="text-align:center;">
                                <div>
                                    <button type="button" id="lock" value="'.$user->id.'" class="btn btn-xs btn-success"><i class="fal fa-sync-alt"></i> Khoá</button>
                                    <button type="button" id="remove" value="'.$user->id.'" class="btn btn-xs btn-danger"><i class="fal fa-trash-alt"></i> Xoá</button>
                                </div>
                            </div>
                       ';
                } else {
                    return '
                            <div style="text-align:center;">
                                <div>
                                    <button id="unlock" value="'.$user->id.'" class="btn btn-xs btn-success"><i class="fal fa-sync-alt"></i> Mở khoá</button>
                                    <button id="remove" value="'.$user->id.'" class="btn btn-xs btn-danger"><i class="fal fa-trash-alt"></i> Xoá</button>
                                </div>
                            </div>
                    ';
                }
            })
            ->rawColumns(['cmnd', 'holot', 'ten', 'sdt', 'email', 'trinhdo', 'quanhuyen', 'khuvucday', 'trangthai', 'action'])
            ->make(true);
    }

}
