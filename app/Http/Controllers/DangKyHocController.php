<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DangkyHocRequest;
use Mail;
use App\Mail\DangkyHocEmail;
use App\Mail\adminDangKyHocEmail;
use App\PhieuDangKy;
use App\LopHoc;

class DangKyHocController extends Controller
{
    public function index()
    {
        $lophoc = LopHoc::all();
        return view('home.dangkyhoc', compact('lophoc'));
    }

    public function store(DangkyHocRequest $request)
    {
        $phieudk = new PhieuDangKy();
        $phieudk->hoten = $request->frmhoten;
        $phieudk->diachi = $request->frmdiachi;
        $phieudk->email = $request->frmemail;
        $phieudk->sdt = $request->frmsdt;
        $phieudk->lophoc = $request->frmlophoc;
        $phieudk->monhoc = $request->frmmonhoc;
        $phieudk->loailop = $request->frmloailop;
        $phieudk->sohocsinh = $request->frmsohocsinh;
        $phieudk->hocluc = $request->frmhocluc;
        $phieudk->sobuoihoc = $request->frmsobuoihoc;
        $phieudk->thoigianhoc = $request->frmthoigianhoc;
        $phieudk->yeucau = $request->frmyeucau;
        $phieudk->yeucauthem = $request->frmyeucaukhac;

        if($phieudk->save()){
            if(!empty($request->frmemail))
            {
                $data = ['hoten' => $request->frmhoten];
                Mail::to($request->frmemail)->send(new DangkyHocEmail($data));
            }

                Mail::to(config('mail.admin_address'))->send(new adminDangKyHocEmail());

            $notification = ['status' => 'success', 'message' => 'Cảm ơn anh(chị) đã lựa chọn ' . config('app.name') . '. Chúng tôi sẽ liên hệ lại với anh(chị) để trao đổi thêm.'];
            return redirect('/')->with($notification);
        }
        else{
            $notification = ['status' => 'error', 'message' => 'Xin lỗi không thể hoàn tất công việc! Anh(chị) vui lòng kiểm tra lại các thông tin.'];
            return redirect()->back()->with($notification)->withInput();
        }
    }
}
