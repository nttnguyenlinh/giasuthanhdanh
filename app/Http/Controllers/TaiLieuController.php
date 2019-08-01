<?php

namespace App\Http\Controllers;

use App\BaiViet;
use Illuminate\Http\Request;

class TaiLieuController extends Controller
{
    public function index()
    {
        $tailieu = BaiViet::where('danhmuc', 2, '&and')->where('trangthai', 1)->get();
        return view('home.tailieuhoctap', compact('tailieu'));
    }

    public function chitiet(Request $request)
    {
        $tailieu = BaiViet::where('slug', 'like', $request->slug)->first();
        if(!empty($tailieu))
            return view('home.chitiettailieu', compact('tailieu'));
        else
            return abort(404);
    }
}
