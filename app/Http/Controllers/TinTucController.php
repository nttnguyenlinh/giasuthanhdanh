<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BaiViet;

class TinTucController extends Controller
{
    public function index()
    {
        $tintuc = BaiViet::where('danhmuc', 1, '&and')->where('trangthai', 1)->get();
        return view('home.tintuc', compact('tintuc'));
    }

    public function chitiet(Request $request)
    {
        $tintuc = BaiViet::where('slug', 'like', $request->slug)->first();
        if(!empty($tintuc))
            return view('home.chitiettintuc', compact('tintuc'));
        else
            return abort(404);
    }
}
