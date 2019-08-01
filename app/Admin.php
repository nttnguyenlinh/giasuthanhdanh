<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\AdminPasswordReset;
use DataTables, Carbon\Carbon;

class Admin extends Authenticatable
{
    use Notifiable;
    protected $guard = 'admin';
    protected $table = 'admins';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminPasswordReset($token));
    }

    public static function ds_nguoidung()
    {
        $data = Admin::query();

        return Datatables::of($data)
            ->editColumn('id', function($user){
                return '<button class="btn-id">' . $user->id . '</button>';
            })
            ->editColumn('email_verified_at', function ($user) {
                if ($user->email_verified_at != null) {
                    return '<center><span class="badge badge-success"><i class="fal fa-check"></i></span></center>';
                } else {
                    return '<center><span class="badge badge-danger"><i class="fal fa-times"></i></span></center>';
                }
            })
            ->editColumn('is_active', function ($user) {
                if ($user->is_active == 1) {
                    return '<center><span class="badge badge-success">Hoạt động</span></center>';
                } else {
                    return '<center><span class="badge badge-danger">Khoá</span></center>';
                }
            })
            ->editColumn('created_at', function ($user) {
                return '<center><span>' . Carbon::parse($user->created_at)->format('d-m-Y') . '</span></center>';
            })
            ->addColumn('action', function ($user) {
                if ($user->is_active == 1) {
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
            ->rawColumns(['id', 'email_verified_at', 'is_active', 'created_at', 'action'])
            ->make(true);
    }

}
