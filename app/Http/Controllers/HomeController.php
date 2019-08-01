<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GiaSu;
use App\BaiViet;
class HomeController extends Controller
{

    public function index()
    {
        $gioithieu = BaiViet::select('noidung')->where('danhmuc', 5)->get()->first();
        $phuhuynhcb = BaiViet::select('noidung')->where('danhmuc', 6)->get()->first();
        $giasucb = BaiViet::select('noidung')->where('danhmuc', 7)->get()->first();
        $cacloailop = BaiViet::select('noidung')->where('danhmuc', 8)->get()->first();
        return view('home.index', compact('gioithieu', 'phuhuynhcb', 'giasucb', 'cacloailop'));
    }

    public function kiemtra_cmnd(Request $request)
    {
        $return[] = '';
        $giasu = GiaSu::where('cmnd', $request->cmnd);

        if (!$giasu->exists())
            $return = ['status' => 'error', 'message' => 'Xin lỗi không tìm thấy hồ sơ.'];
        else
            $return = ['status' => 'success', 'message' => 'Xin chào'];
        return json_encode($return);
    }
}
