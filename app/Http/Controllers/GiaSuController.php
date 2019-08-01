<?php

namespace App\Http\Controllers;

use App\GiaSu;
use App\Http\Requests\CapNhatGiaSuRequest;
use App\Http\Requests\DoiMatKhauRequest;
use App\KhuVuc;
use App\LopHoc;
use App\Mail\adminDangKyGiaSuEmail;
use App\Mail\DangkyGiaSuEmail;
use App\MonHoc;
use App\PhieuMoLop;
use App\PhieuNhanLop;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth, Hash;
use Illuminate\Support\Facades\Storage;

class GiaSuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $khuvuc = KhuVuc::all();
        $lophoc = LopHoc::all();
        $monhoc = MonHoc::all();
        $giasu = GiaSu::find(Auth::user()->id);
        $dslop = PhieuNhanLop::where('giasu', Auth::user()->id)
            ->leftJoin('phieu_mo_lop', 'phieu_nhan_lop.lop', '=', 'phieu_mo_lop.malop')
            ->select(['phieu_mo_lop.malop', 'phieu_mo_lop.lopday', 'phieu_mo_lop.monday', 'phieu_mo_lop.loailop',
                'phieu_mo_lop.luong', 'phieu_mo_lop.lephi', 'phieu_mo_lop.sobuoihoc', 'phieu_mo_lop.thoigianhoc',
                'phieu_mo_lop.thongtin', 'phieu_mo_lop.yeucau', 'phieu_nhan_lop.trangthai'])
            ->orderBy('phieu_nhan_lop.id', 'desc')->get();
        return view('giasu.index', compact('dslop', 'khuvuc', 'monhoc', 'lophoc', 'giasu'));
    }

    public function store(CapNhatGiaSuRequest $request)
    {
        $giasu = GiaSu::find(Auth::user()->id);
        $giasu->holot = $request->frmholot;
        $giasu->ten = $request->frmten;
        $giasu->ngaysinh = Carbon::createFromFormat('d-m-Y', $request->frmngaysinh)->format('Y-m-d');
        $giasu->gioitinh = $request->frmgioitinh;
        $giasu->noisinh = $request->frmnoisinh;
        $giasu->diachi = $request->frmdiachi;
        $giasu->quanhuyen = $request->frmquanhuyen;
        $giasu->tinhthanh = $request->frmtinhthanh;
        $giasu->truonghoc = $request->frmtruonghoc;
        $giasu->nganhhoc = $request->frmnganhhoc;
        $giasu->namtn = $request->frmnamtn;
        $giasu->trinhdo = $request->frmtrinhdo;
        $giasu->monday = implode(",",$request->frmmonday);
        $giasu->lopday = implode(",",$request->frmlopday);
        $giasu->khuvucday = implode(",",$request->frmkhuvuc);
        $giasu->thongtinkhac = $request->frmthongtinkhac;

        $anhthe_old = $giasu->anhthe;
        $anhcmnd_old = $giasu->anhcmnd;

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
            $giasu->anhthe = $newfile;
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
            $giasu->anhcmnd = $cmnd;
        }

        if($giasu->save())
        {
            if ($request->hasFile('frmanhthe'))
            {
                Storage::disk()->delete('/anhthe/'.$anhthe_old);
                Storage::disk()->putFileAs('/anhthe/', $file, $newfile);
            }

            if ($request->hasFile('frmanhcmnd'))
            {
                Storage::disk()->delete('/anhcmnd/'.$anhcmnd_old);
                Storage::disk()->putFileAs('/anhcmnd/', $file2, $cmnd);
            }
            $notification = ['status' => 'success', 'message' => 'Thông tin đã được cập nhật.'];
            return redirect()->back()->with($notification);
        }
        else{
            $notification = ['status' => 'error', 'message' => 'Xin lỗi, không thể hoàn tất công việc.'];
            return redirect()->back()->with($notification)->withInput();
        }
    }
    public function dmk()
    {
        return view('giasu.doimatkhau');
    }

    public function tdmk(DoiMatKhauRequest $request)
    {
        $giasu = GiaSu::find(Auth::user()->id);
        $old = trim($request->mkht);
        $new = trim($request->mkm);
        if(Hash::check($old, $giasu->password))
            if($old !== $new)
            {
                $giasu->password = Hash::make($new);
                if($giasu->save())
                    return redirect()->back()->with(['status'=>'success','message'=>'Mật khẩu đã được thay đổi.']);
                else
                    return redirect()->back()->with(['status'=>'error','message'=>'Có lỗi trong quá trình thực hiện.']);
            }
            else
                return redirect()->back()->with(['status'=>'error','message'=>'Mật khẩu mới phải khác mật khẩu hiện tại.']);
        else
            return redirect()->back()->with(['status'=>'error','message'=>'Mật khẩu hiện tại không chính xác.']);
    }
}
