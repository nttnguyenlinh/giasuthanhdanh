<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NoiQuyController extends Controller
{
    public function index()
    {
        return view('home.noiquynhanlop');
    }

}
