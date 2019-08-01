<?php

namespace App\Http\Controllers;

use App\Mail\adminDangKyGiaSuEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Requests\DangkyGiaSuRequest;
use App\Mail\DangkyGiaSuEmail;
use Mail, Hash, App\GiaSu, App\LopHoc, App\MonHoc, App\KhuVuc, Carbon\Carbon;

class DangKyGiaSuController extends Controller
{

    public function index()
    {
        $lophoc = LopHoc::all();
        $monhoc = MonHoc::all();
        $khuvuc = KhuVuc::all();

        return view('home.dangkygiasu', compact('lophoc', 'monhoc', 'khuvuc'));
    }

    public function store(DangkyGiaSuRequest $request)
    {
        $phieudk = new GiaSu();
        $phieudk->holot = $request->frmholot;
        $phieudk->ten = $request->frmten;
        $phieudk->ngaysinh = Carbon::createFromFormat('d-m-Y', $request->frmngaysinh)->format('Y-m-d');
        $phieudk->gioitinh = $request->frmgioitinh;
        $phieudk->noisinh = $request->frmnoisinh;
        $phieudk->cmnd = $request->frmcmnd;
        $phieudk->diachi = $request->frmdiachi;
        $phieudk->quanhuyen = $request->frmquanhuyen;
        $phieudk->tinhthanh = $request->frmtinhthanh;
        $phieudk->email = $request->frmemail;
        $phieudk->sdt = $request->frmsdt;
        $phieudk->password = Hash::make(str_replace('-', '', $request->frmngaysinh));
        $phieudk->truonghoc = $request->frmtruonghoc;
        $phieudk->nganhhoc = $request->frmnganhhoc;
        $phieudk->namtn = $request->frmnamtn;
        $phieudk->trinhdo = $request->frmtrinhdo;
        $phieudk->monday = implode(",",$request->frmmonday);
        $phieudk->lopday = implode(",",$request->frmlopday);
        $phieudk->khuvucday = implode(",",$request->frmkhuvuc);
        $phieudk->thongtinkhac = $request->frmthongtinkhac;

         if ($request->hasFile('frmanhthe'))
         {
             $file = $request->file('frmanhthe');
             $file_name = $file->getClientOriginalName(); // Get Name
             $file_extension = $file->getClientOriginalExtension(); // Get Extension

             if ($file_extension != 'png' && $file_extension != 'jpg' && $file_extension != 'jpeg')
             {
                 $notification = ['status' => 'error', 'message' => 'Chỉ hỗ trợ tệp hình ảnh (png, jpg, jpeg).'];
                 return redirect()->back()->with($notification)->withInput();
             }
             if ($file->getClientSize() > 3145728) { //3 MB (size is also in bytes)
                 $notification = ['status' => 'error', 'message' => 'Chỉ hỗ trợ tệp hình ảnh 3MB trở xuống.'];
                 return redirect()->back()->with($notification)->withInput();
             }
             $newfile = time() . '_' . $file_name;
             $phieudk->anhthe = $newfile;
         }

        if ($request->hasFile('frmanhcmnd'))
        {
            $file2 = $request->file('frmanhcmnd');
            $file_name2 = $file2->getClientOriginalName(); // Get Name
            $file_extension2 = $file2->getClientOriginalExtension(); // Get Extension

            if ($file_extension2 != 'png' && $file_extension2 != 'jpg' && $file_extension2 != 'jpeg')
            {
                $notification = ['status' => 'error', 'message' => 'Chỉ hỗ trợ tệp hình ảnh (png, jpg, jpeg).'];
                return redirect()->back()->with($notification)->withInput();
            }
            if ($file2->getClientSize() > 3145728) { //3 MB (size is also in bytes)
                $notification = ['status' => 'error', 'message' => 'Chỉ hỗ trợ tệp hình ảnh 3MB trở xuống.'];
                return redirect()->back()->with($notification)->withInput();
            }
            $cmnd = time() . '_' . $file_name2;
            $phieudk->anhcmnd = $cmnd;
        }

        if($phieudk->save())
        {
            if ($request->hasFile('frmanhthe'))
                Storage::disk()->putFileAs('/anhthe/', $file, $newfile);

            if ($request->hasFile('frmanhcmnd'))
                    Storage::disk()->putFileAs('/anhcmnd/', $file2, $cmnd);

            $data = ["frmhoten" => $request->frmholot . ' ' . $request->frmten];
            Mail::to($request->frmemail)->send(new DangkyGiaSuEmail($data));
            Mail::to(config('mail.admin_address'))->send(new adminDangKyGiaSuEmail());

            $notification = ['status' => 'success', 'message' => 'Cảm ơn anh(chị) đã lựa chọn ' . config('app.name') . '. Chúng tôi sẽ liên hệ lại với anh(chị) để xét duyệt thông tin.'];
            return redirect('/')->with($notification);
        }
        else{
            $notification = ['status' => 'error', 'message' => 'Xin lỗi không thể hoàn tất công việc! Anh(chị) vui lòng kiểm tra lại các thông tin.'];
            return redirect()->back()->with($notification)->withInput();
        }
    }
}
