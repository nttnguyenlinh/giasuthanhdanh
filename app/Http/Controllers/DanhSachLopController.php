<?php

namespace App\Http\Controllers;

use App\Mail\adminDangKyDayEmail;
use App\Mail\adminDangKyGiaSuEmail;
use App\Mail\DangkyDayEmail;
use App\Mail\DangkyGiaSuEmail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Requests\DangkyGiaSuRequest;
use Mail, Hash;
use Illuminate\Http\Request, Carbon\Carbon;
use App\GiaSu, App\KhuVuc, App\MonHoc, App\LopHoc, App\PhieuMoLop, App\PhieuNhanLop, App\PhieuDangKy;

class DanhSachLopController extends Controller
{
    public function index()
    {
        $khuvuc = KhuVuc::all();
        $lophoc = LopHoc::all();
        $dslop = PhieuMoLop::where('trangthai', 0)->orderBy('created_at', 'desc')->paginate(6);
        return view('home.danhsachlop', compact('khuvuc','lophoc', 'dslop'));
    }

    public function chitietlop(Request $request)
    {
        $lophoc = LopHoc::all();
        $monhoc = MonHoc::all();
        $khuvuc = KhuVuc::all();

        $chitiet = PhieuMoLop::where('slug', 'like', $request->slug)->first();
        if(!empty($chitiet))
            return view('home.chitietlop', compact('chitiet', 'lophoc', 'monhoc', 'khuvuc'));
        else
            return abort(404);
    }

    public function dangkyday(Request $request)
    {
        if(!empty($request->nhanlop))
        {
            $count = PhieuNhanLop::where('lop', $request->malop)->count();
            if($count >= 10)
            {
                $notification = ['status' => 'error', 'message' => 'Lớp này đã đạt đến số lượng đăng ký cho phép. Mời chọn lớp khác.'];
                return redirect()->back()->with($notification);
            }

            else
            {
                $giasu = GiaSu::where('cmnd', $request->ccmnd)->first();
                if($giasu)
                {
                    if($giasu->trangthai == 1)
                    {
                        $count = PhieuNhanLop::where('lop', $request->malop, '&and')->where('giasu', $giasu->id)->count();
                        if($count == 0)
                        {
                            $phieunhan = new PhieuNhanLop();
                            $phieunhan->lop = $request->malop;
                            $phieunhan->giasu = $giasu->id;
                            $phieunhan->thoigianday = Carbon::createFromFormat('d-m-Y', $request->thoigianday)->format('Y-m-d');
                            $phieunhan->ghichu = $request->ghichu;

                            if($phieunhan->save())
                            {
                                $data = ['hoten' => $giasu->holot . ' ' .$giasu->ten];
                                Mail::to($giasu->email)->send(new DangkyDayEmail($data));
                                Mail::to(config('mail.admin_address'))->send(new adminDangKyDayEmail());

                                $notification = ['status' => 'success', 'message' => 'Thông tin nhận lớp của anh(chị) đã được trung tâm ghi nhận. Chúng tôi sẽ liên hệ lại với anh(chị) để trao đổi và xét duyệt thông tin.'];
                                return redirect()->back()->with($notification);
                            }
                            else
                            {
                                $notification = ['status' => 'error', 'message' => 'Xin lỗi! Trung tâm không thể hoàn tất việc nhận lớp của bạn.'];
                                return redirect()->back()->with($notification);
                            }

                        }
                        else
                        {
                            $notification = ['status' => 'error', 'message' => 'Xin lỗi! Bạn đã đăng ký lớp này rồi, mời bạn chọn lớp khác.'];
                            return redirect()->back()->with($notification);
                        }
                    }
                    else
                    {
                        $notification = ['status' => 'error', 'message' => 'Xin lỗi! Tài khoản của bạn đang bị khoá nên không thể nhận lớp.'];
                        return redirect()->back()->with($notification);
                    }
                }
                else
                {
                    $notification = ['status' => 'error', 'message' => 'Không tìm thấy hồ sơ. Bạn vui lòng đăng ký làm gia sư để đồng hành cùng trung tâm nhé!'];
                    return redirect()->back()->with($notification);
                }
            }
        }

        if(!empty($request->dangky_day))
        {
            $this->validate($request,[
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
            ],
                [
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
                ]
            );

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

                $data = ['hoten' => $request->frmholot . ' ' . $request->frmten];
                Mail::to($request->frmemail)->send(new DangkyGiaSuEmail($data));
                Mail::to(config('mail.admin_address'))->send(new adminDangkyGiaSuEmail());

                $count = PhieuNhanLop::where('lop', $request->lop)->count();
                if ($count >= 10) {
                    $notification = ['status' => 'error', 'message' => 'Lớp này đã đạt đến số lượng đăng ký cho phép. Mời chọn lớp khác.'];
                    return redirect()->back()->with($notification);
                }
                else
                {
                    $giasu = GiaSu::where('cmnd', $request->frmcmnd)->first();
                    $count = PhieuNhanLop::where('lop', $request->lop, '&and')->where('giasu', $giasu->id)->count();
                    if ($count == 0)
                    {
                        $phieunhan = new PhieuNhanLop();
                        $phieunhan->lop = $request->lop;
                        $phieunhan->giasu = $giasu->id;

                        if ($phieunhan->save())
                        {
                            if (!empty($giasu->email))
                            {
                                $data = ['hoten' => $giasu->holot . ' ' .$giasu->ten];
                                Mail::to($giasu->email)->send(new DangkyDayEmail($data));
                                Mail::to(config('mail.admin_address'))->send(new adminDangKyDayEmail());
                            }

                            $notification = ['status' => 'success', 'message' => 'Cảm ơn anh(chị) đã lựa chọn ' . config('app.name') . '. Chúng tôi sẽ liên hệ lại với anh(chị) để xét duyệt thông tin.'];
                            return redirect('/')->with($notification);
                        }
                    }
                    else
                    {
                        $notification = ['status' => 'error', 'message' => 'Xin lỗi! Bạn đã đăng ký lớp này rồi, mời bạn chọn lớp khác.'];
                        return redirect('/')->with($notification);
                    }

                }
            }
            else{
                $notification = ['status' => 'error', 'message' => 'Xin lỗi không thể tạo tài khoản! Anh(chị) vui lòng kiểm tra lại các thông tin.'];
                return redirect()->back()->with($notification)->withInput();
            }
        }

    }

    public function timkiemlop(Request $request)
    {
        $khuvuc = KhuVuc::all();
        $lophoc = LopHoc::all();

        if(!empty($request->timkiem))
        {
            if(!empty($request->quanhuyen))
            {
                $kv = KhuVuc::where('id', $request->quanhuyen)->first();
                $quanhuyen = $kv->tenkv;
            }
            else
                $quanhuyen = "";

            if(!empty($request->lopday))
            {
                $lop = LopHoc::where('id', $request->lopday)->first();
                $lopday = $lop->tenlop;
            }
            else
                $lopday = "";

            $tukhoa = $request->tukhoa;

            $dslop = PhieuMoLop::where(function($q) use ($tukhoa){
                $q->where('malop', 'like', '%'.$tukhoa.'%')->orWhere('monday', 'like', '%'.$tukhoa.'%');
            })
                ->where(function($q2) use ($quanhuyen){
                    $q2->orwhere('diachi', 'like', '%'.$quanhuyen.'%');
                })
                ->where(function($q3) use ($lopday){
                    $q3->orwhere('lopday', 'like', '%'.$lopday.'%');
                })
                ->where('trangthai', 0)
                ->orderBy('created_at', 'desc')->paginate(6);
        }
        else
            $dslop = PhieuMoLop::where('trangthai', 0)->orderBy('created_at', 'desc')->paginate(6);
        return view('home.danhsachlop', compact('khuvuc','lophoc', 'dslop'));
    }
}
