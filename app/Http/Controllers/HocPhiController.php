<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BaiViet;

class HocPhiController extends Controller
{
    public function index()
    {
        $hocphi = BaiViet::select('noidung')->where('danhmuc', 4)->get()->first();
        return view('home.hocphithamkhao', compact('hocphi'));
    }
}
