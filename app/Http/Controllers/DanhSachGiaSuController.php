<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request, Carbon\Carbon;
use App\GiaSu, App\KhuVuc, App\MonHoc, App\LopHoc;

class DanhSachGiaSuController extends Controller
{
    public function index()
    {
        $khuvuc = KhuVuc::all();
        $lophoc = LopHoc::all();
        $monhoc = MonHoc::all();
        $giasu = GiaSu::where('trangthai', 1)->orderBy('created_at', 'desc')->paginate(8);
        return view('home.danhsachgiasu', compact('khuvuc','lophoc', 'monhoc', 'giasu'));
    }

    public function timkiemgiasu(Request $request)
    {
        $khuvuc = KhuVuc::all();
        $lophoc = LopHoc::all();
        $monhoc = MonHoc::all();

        if (!empty($request->timkiem))
        {
            $monday = $request->monday;
            $lopday = $request->lopday;
            $quanhuyen = $request->quanhuyen;
            $trinhdo = $request->trinhdo;

            $giasu = GiaSu::where('monday', 'like', '%'.$monday.'%')->where('trangthai', 1)->orderBy('created_at', 'desc')->paginate(8);
            if(!empty($lopday))
                $giasu = GiaSu::where('monday', 'like', '%'.$monday.'%')->where('lopday', 'like', '%'.$lopday.'%')->where('trangthai', 1)->orderBy('created_at', 'desc')->paginate(8);
            if(!empty($quanhuyen))
                $giasu = GiaSu::where('monday', 'like', '%'.$monday.'%')->where('lopday', 'like', '%'.$lopday.'%')->where('khuvucday', 'like', '%'.$quanhuyen.'%')->where('trangthai', 1)->orderBy('created_at', 'desc')->paginate(8);
            if(!empty($trinhdo))
                $giasu = GiaSu::where('monday', 'like', '%'.$monday.'%')->where('lopday', 'like', '%'.$lopday.'%')->where('khuvucday', 'like', '%'.$quanhuyen.'%')->where('trinhdo', $trinhdo)->where('trangthai', 1)->orderBy('created_at', 'desc')->paginate(8);

        }
        else
            $giasu = GiaSu::where('trangthai', 1)->orderBy('created_at', 'desc')->paginate(8);
        return view('home.danhsachgiasu', compact('khuvuc', 'lophoc', 'monhoc', 'giasu'));
    }
}
