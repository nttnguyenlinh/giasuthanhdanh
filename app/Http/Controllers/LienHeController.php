<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BaiViet;

class LienHeController extends Controller
{
    public function index()
    {
        $gioithieu = BaiViet::select('noidung')->where('danhmuc', 9)->get()->first();
        return view('home.lienhe', compact('gioithieu'));
    }
}
