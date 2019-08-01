<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Str;
use Auth, Hash, DataTables, Carbon\Carbon;
use App\Http\Requests\NguoiDungRequest;
use App\Admin, App\GiaSu, App\MonHoc, App\LopHoc, App\KhuVuc;
use App\PhieuDangKy, App\PhieuMoLop, App\PhieuNhanLop, App\BaiViet;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return view('admin.index');
    }

    public function nguoidung()
{
    return view('admin.nguoidung');
}

    public function ds_nguoidung()
    {
        $data = Admin::ds_nguoidung();
        return $data;
    }

    public function them_nguoidung(NguoiDungRequest $request)
    {
        $adm = new Admin();
        $adm->name = trim($request->name);
        $adm->email = trim($request->email);
        $adm->email_verified_at = Carbon::now();
        $adm->password = Hash::make(trim($request->password));
        $adm->is_active = 1;

        if ($adm->save()) {
            $notification = ['status' => 'success', 'message' => 'Tài khoản đã được thêm.'];
            return redirect()->back()->with($notification);
        } else {
            $notification = ['status' => 'error', 'message' => 'Tài khoản chưa được thêm.'];
            return redirect()->back()->with($notification);
        }
    }

    public function thaydoi_nguoidung(Request $request)
    {
        $return[] = '';
            $admin = Admin::find($request->id);
            if ($request->is_active == "lock")
                $admin->is_active = 0;

            if ($request->is_active == "unlock")
                $admin->is_active = 1;

            if ($admin->save())
                $return = ['status' => 'success', 'message' => 'Thay đổi thành công.'];
            else
                $return = ['status' => 'error', 'message' => 'Không thể thay đổi.'];

        return json_encode($return);
    }

    public function xoa_nguoidung(Request $request)
    {
        $return[] = '';
        $admin = Admin::find($request->id);
        if($admin->delete())
            $return = ['status' => 'success', 'message' => 'Xoá thành công.'];
        else
            $return = ['status' => 'error', 'message' => 'Không thể xoá.'];
        return json_encode($return);
    }

    public function giasu()
    {
        return view('admin.giasu');
    }

    public function ds_giasu()
    {
        $data = GiaSu::ds_giasu();
        return $data;
    }

    public function thaydoi_giasu(Request $request)
    {
        $return[] = '';
             $giasu= GiaSu::find($request->id);
            if ($request->trangthai == "lock")
                $giasu->trangthai = 0;

            if ($request->trangthai == "unlock")
                $giasu->trangthai = 1;

            if ($giasu->save())
                $return = ['status' => 'success', 'message' => 'Thay đổi thành công.'];
            else
                $return = ['status' => 'error', 'message' => 'Không thể thay đổi.'];

        return json_encode($return);
    }

    public function xoa_giasu(Request $request)
    {
        $return[] = '';
        $giasu = GiaSu::find($request->id);
        $should_delete = true;
        if($giasu->phieu_nhan_lop()->count() > 0)
            $should_delete = false;
        if($should_delete == true)
        {
            $giasu->delete();
            $return = ['status' => 'success', 'message' => 'Xoá thành công.'];
        }
        else
            $return = ['status' => 'error', 'message' => 'Không thể xoá.'];
        return json_encode($return);
    }

    public function laythongtin_giasu(Request $request)
    {
        $id = $request->id;
        $giasu = GiaSu::find($id);

        $khuvuc = array();
        $monday = array();
        $lopday = array();

        foreach(KhuVuc::all() as $i)
            foreach(explode(",",$giasu->khuvucday) as $item)
                if($item == $i->id)
                    $khuvuc[] = $i->tenkv;

        foreach(LopHoc::all() as $i)
            foreach(explode(",",$giasu->lopday) as $item)
                if($item == $i->id)
                    $lopday[] = $i->tenlop;

        foreach(MonHoc::all() as $i)
            foreach(explode(",",$giasu->monday) as $item)
                if($item == $i->id)
                    $monday[] = $i->tenmon;

        $return = array(
            'holot' => $giasu->holot,
            'ten' => $giasu->ten,
            'ngaysinh' => Carbon::parse($giasu->ngaysinh)->format('d-m-Y'),
            'noisinh' => $giasu->noisinh,
            'diachi' => $giasu->diachi,
            'quanhuyen' => $giasu->quanhuyen,
            'tinhthanh' => $giasu->tinhthanh,
            'truonghoc' => $giasu->truonghoc,
            'nganhhoc' => $giasu->nganhhoc,
            'namtn' => ($giasu->namtn - 4) . ' - ' . $giasu->namtn,
            'trinhdo' => $giasu->trinhdo,
            'monday' => implode(', ', $monday),
            'lopday' => implode(', ', $lopday),
            'khuvucday' => implode(', ', $khuvuc),
            'thongtinkhac' => $giasu->thongtinkhac,
            'anhthe' => $giasu->anhthe,
            'anhcmnd' => $giasu->anhcmnd
        );
        return json_encode($return);
    }

    public function dangky(){
        return view('admin.dangky');
    }

    public function ds_dangky()
    {
        $data = PhieuDangKy::ds_dangky();
        return $data;
    }

    public function xoa_dangky(Request $request)
    {
        $return[] = '';
        $pdk = PhieuDangKy::find($request->id);
        $should_delete = true;
        if($pdk->phieu_mo_lop()->count() > 0)
            $should_delete = false;
        if($should_delete == true)
        {
            $pdk->delete();
            $return = ['status' => 'success', 'message' => 'Xoá thành công.'];
        }
        else
            $return = ['status' => 'error', 'message' => 'Không thể xoá.'];
        return json_encode($return);
    }

    public function thaydoi_dangky(Request $request)
    {
        $tb = new PhieuMoLop();
        $tb->malop = trim($request->malop);
        $tb->slug =Str::slug($request->monday). '-' . Str::slug($request->lopday) . '-' . time();
        $tb->madk = trim($request->phieudangky_id);
        $tb->lopday = trim($request->lopday);
        $tb->monday = $request->monday;
        $tb->loailop = trim($request->loailop);
        $tb->diachi = $request->diachi;
        $tb->luong = str_replace('.', '', trim($request->luong));
        $tb->lephi = trim($request->lephi);
        $tb->sobuoihoc = trim($request->sobuoihoc);
        $tb->thoigianhoc = $request->thoigianhoc;
        $tb->thongtin = $request->thongtin;
        $tb->yeucau = $request->yeucau;
        if ($tb->save()) {
            $pdk= PhieuDangKy::find(trim($request->phieudangky_id));
            $pdk->trangthai = 1;
            $pdk->save();

            $notification = ['status' => 'success', 'message' => 'Lớp học đã được thêm.'];
            return redirect()->back()->with($notification);
        } else {
            $notification = ['status' => 'error', 'message' => 'Có lỗi khi thêm lớp học.'];
            return redirect()->back()->with($notification);
        }
    }

    public function laythongtin_dangky(Request $request)
    {
        $id = $request->id;
        $pdk = PhieuDangKy::find($id);

        $return = array(
            'id' => $pdk->id,
            'diachi' => $pdk->diachi,
            'monday' => $pdk->monhoc,
            'lopday' => $pdk->lophoc,
            'loailop' => $pdk->loailop,
            'sohocsinh' =>$pdk->sohocsinh,
            'hocluc' => $pdk->hocluc,
            'sobuoihoc' => $pdk->sobuoihoc,
            'thoigianhoc' => $pdk->thoigianhoc,
            'yeucau' => $pdk->yeucau,
            'yeucauthem' => $pdk->yeucauthem
        );
        return json_encode($return);
    }

    public function kiemtra_malop(Request $request)
    {
        $return[] = '';
        $lop = PhieuMoLop::where('malop', $request->malop);
        if (!$lop->exists())
            $return = ['status' => 'success', 'message' => 'Mã này có thể sử dụng.'];
        else
            $return = ['status' => 'error', 'message' => 'Không thể sử dụng mã này. Vui lòng tạo mã khác!'];
        return json_encode($return);
    }

    public function lop(){
        return view('admin.danhsachlop');
    }

    public function ds_lop()
    {
        $data = PhieuMoLop::ds_lop();
        return $data;
    }

    public function thaydoi_dslop(Request $request)
    {
        $return[] = '';
        $pml = PhieuMoLop::find($request->id);

        if($request->trangthai == 1)
            $pml->trangthai = 0;
        else
            $pml->trangthai = 1;
        if($pml->save())
            $return = ['status' => 'success', 'message' => 'Thay đổi thành công.'];
        else
            $return = ['status' => 'error', 'message' => 'Không thể thay đổi.'];
        return json_encode($return);
    }

    public function xoa_dslop(Request $request)
    {
        $return[] = '';
        $pml = PhieuMoLop::find($request->id);
        $should_delete = true;
        if($pml->phieu_nhan_lop->count() > 0)
            $should_delete = false;
        if($should_delete == true)
        {
            $pml->delete();
            $return = ['status' => 'success', 'message' => 'Xoá thành công.'];
        }
        else
            $return = ['status' => 'error', 'message' => 'Không thể xoá.'];
        return json_encode($return);
    }

    public function laythongtin_dslop(Request $request)
    {
        $id = $request->id;
        $pml = PhieuMoLop::find($id);

        $return = array(
            'id' => $pml->id,
            'malop' => $pml->malop,
            'monday' => $pml->monday,
            'lopday' => $pml->lopday,
            'loailop' => $pml->loailop,
            'diachi' => $pml->diachi,
            'luong' =>$pml->luong,
            'lephi' => $pml->lephi,
            'sobuoihoc' => $pml->sobuoihoc,
            'thoigianhoc' => $pml->thoigianhoc,
            'thongtin' => $pml->thongtin,
            'yeucau' => $pml->yeucau
        );
        return json_encode($return);
    }

    public function capnhat_dslop(Request $request)
    {
        $pml = PhieuMoLop::find($request->id);
        $pml->slug =Str::slug($request->monday). '-' . Str::slug($request->lopday) . '-' . time();
        $pml->lopday = trim($request->lopday);
        $pml->monday = trim($request->monday);
        $pml->loailop = trim($request->loailop);
        $pml->diachi = $request->diachi;
        $pml->luong = str_replace('.', '', trim($request->luong));
        $pml->lephi = trim($request->lephi);
        $pml->sobuoihoc = trim($request->sobuoihoc);
        $pml->thoigianhoc = $request->thoigianhoc;
        $pml->thongtin = $request->thongtin;
        $pml->yeucau = $request->yeucau;

        if($pml->save())
            $notification = ['status' => 'success', 'message' => 'Cập nhật thông tin thành công.'];
        else
            $notification = ['status' => 'error', 'message' => 'Không thể cập nhật thông tin.'];
        return redirect()->back()->with($notification);
    }

    public function nhanday()
    {
        $pnd = PhieuNhanLop::select('lop')->groupBy('lop')->get();
        return view('admin.danhsachnhanday', compact('pnd'));
    }

    public function laythongtin_nhanday(Request $request)
    {
        return PhieuNhanLop::laythongtin_nhanday($request);
    }

    public function thaydoi_nhanday(Request $request)
    {
        $return[] = '';
        $pnd = PhieuNhanLop::find($request->id);
        $pnd->trangthai = $request->status;
        if($pnd->save())
        {
            if($request->status == 2 || $request->status == 3 || $request->status == 4)
            {
                $pml = PhieuMoLop::find($request->molop_id);
                $pml->trangthai = 1;
                $pml->save();
            }
            $return = ['status' => 'success', 'message' => 'Thay đổi thành công.'];
        }
        else
            $return = ['status' => 'error', 'message' => 'Không thể thay đổi.'];
        return json_encode($return);
    }

    public function thaydoigs_nhanday(Request $request)
    {
        $return[] = '';
        $pnd = PhieuNhanLop::find($request->id);
        $pnd->giasu = $request->giasu;
        if($pnd->save())
            $return = ['status' => 'success', 'message' => 'Thay đổi thành công.'];
        else
            $return = ['status' => 'error', 'message' => 'Không thể thay đổi.'];
        return json_encode($return);
    }

    public function xoa_nhanday(Request $request)
    {
        $return[] = '';
        $pnl = PhieuNhanLop::find($request->id);
        if($pnl->delete())
            $return = ['status' => 'success', 'message' => 'Xoá thành công.'];
        else
            $return = ['status' => 'error', 'message' => 'Không thể xoá.'];
        return json_encode($return);
    }

    public function baiviet()
    {
        return view('admin.baiviet');
    }

    public function baiviet_them()
    {
        return view('admin.thembaiviet');
    }

    public function ds_baiviet()
    {
        $data = BaiViet::ds_baiviet();
        return $data;
    }

    public function baiviet_xem(Request $request)
    {
        $baiviet = BaiViet::where('id', $request->id)->first();
        if(!empty($baiviet))
            return view('admin.xembaiviet', compact('baiviet'));
        else
            return abort(404);
    }

    public function baiviet_luu(Request $request)
    {
        $bv = new BaiViet();
        $bv->tieude = $request->tieude;
        $bv->slug = Str::slug($request->tieude). '-' . time();
        $bv->danhmuc = $request->danhmuc;
        $bv->mota = $request->mota;
        $bv->noidung = $request->noidung;
        if(!empty($request->anhbia))
            $bv->anhbia = explode("/storage/", $request->anhbia)[1];
        $bv->trangthai = $request->trangthai;
        if ($bv->save())
            return redirect()->route('admin.baiviet')->with(['status' => 'success', 'message' => 'Bài viết đã được thêm.']);
        else
            return redirect()->back()->with(['status' => 'error', 'message' => 'Không thể thêm bài viết.'])->withInput();
    }

    public function media()
    {
        return view('admin.media.index');
    }

    public function kiemtra_sdt(Request $request)
    {
        $return[] = '';
        $data = GiaSu::where('sdt', $request->sdt);
        if (!$data->exists())
            $return = ['status' => 'success', 'message' => 'SĐT này có thể sử dụng.'];
        else
            $return = ['status' => 'error', 'message' => 'SĐT này đã có người sử dụng.'];
        return json_encode($return);
    }

    public function kiemtra_email(Request $request)
    {
        $return[] = '';
        $data = GiaSu::where('email', $request->email);
        if (!$data->exists())
            $return = ['status' => 'success', 'message' => 'Email này có thể sử dụng.'];
        else
            $return = ['status' => 'error', 'message' => 'Email này đã có người sử dụng.'];
        return json_encode($return);
    }

    public function kiemtra_cmnd(Request $request)
    {
        $return[] = '';
        $data = GiaSu::where('cmnd', $request->cmnd);
        if (!$data->exists())
            $return = ['status' => 'success', 'message' => 'CMND/CCCD này có thể sử dụng.'];
        else
            $return = ['status' => 'error', 'message' => 'CMND/CCCD này đã có người sử dụng.'];
        return json_encode($return);
    }

    public function tools()
    {
        $giasu = GiaSu::all();
        return view('admin.tools.index', compact('giasu'));
    }

    public function tools_thaydoi(Request $request)
    {
        if(!empty($request->thaydoiSDT))
        {
            $count = GiaSu::where('sdt', $request->sdt)->where('id', '!=', $request->id)->count();
            if($count != 0)
                return redirect()->back()->with(['status'=>'error','message'=>'Đã được sử dụng!']);
            else {
                $giasu = GiaSu::find($request->id);
                $giasu->sdt = $request->sdt;

                if ($giasu->save())
                    return redirect()->back()->with(['status' => 'success', 'message' => 'Thay đổi thành công!']);
                else
                    return redirect()->back()->with(['status' => 'error', 'message' => 'Không thể thay đổi!']);
            }
        }
        if(!empty($request->thaydoiEmail))
        {
            $count = GiaSu::where('email', $request->email)->where('id', '!=', $request->id)->count();
            if($count != 0)
                return redirect()->back()->with(['status'=>'error','message'=>'Đã được sử dụng!']);
            else {
                $giasu = GiaSu::find($request->id);
                $giasu->email = $request->email;

                if ($giasu->save())
                    return redirect()->back()->with(['status' => 'success', 'message' => 'Thay đổi thành công!']);
                else
                    return redirect()->back()->with(['status' => 'error', 'message' => 'Không thể thay đổi!']);
            }
        }
        if(!empty($request->thaydoiCMND))
        {
            $count = GiaSu::where('cmnd', $request->cmnd)->where('id', '!=', $request->id)->count();
            if($count != 0)
                return redirect()->back()->with(['status'=>'error','message'=>'Đã được sử dụng!']);
            else {
                $giasu = GiaSu::find($request->id);
                $giasu->cmnd = $request->cmnd;

                if ($giasu->save())
                    return redirect()->back()->with(['status' => 'success', 'message' => 'Thay đổi thành công!']);
                else
                    return redirect()->back()->with(['status' => 'error', 'message' => 'Không thể thay đổi!']);
            }
        }
    }

    public function baiviet_xem_luu(Request $request)
    {
        $bv = BaiViet::where('id', $request->id)->first();
        $bv->tieude = $request->tieude;
        $bv->slug = Str::slug($request->tieude). '-' . time();
        $bv->danhmuc = $request->danhmuc;
        $bv->mota = $request->mota;
        $bv->noidung = $request->noidung;
        if(!empty($request->anhbia))
            $bv->anhbia = explode("/storage/", $request->anhbia)[1];
        else
            $bv->anhbia = $bv->anhbia;
        $bv->trangthai = $request->trangthai;
        if ($bv->save())
            return redirect()->route('admin.baiviet')->with(['status' => 'success', 'message' => 'Bài viết đã được lưu.']);
        else
            return redirect()->back()->with(['status' => 'error', 'message' => 'Không thể lưu bài viết.'])->withInput();
    }
    public function baiviet_xoa(Request $request)
    {
        $return[] = '';
        $bv = BaiViet::find($request->id);
        if($bv->delete())
            $return = ['status' => 'success', 'message' => 'Xoá thành công.'];
        else
            $return = ['status' => 'error', 'message' => 'Không thể xoá.'];
        return json_encode($return);
    }
}
