<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class AdminLoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/admin';

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        if (Auth::guard('admin')->check() || Auth::guard('admin')->viaRemember())
            return redirect()->intended(route('admin'));
        return view('auth.admin_login');
    }

    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'is_active' => 1
        ];

        if(Auth::guard('admin')->attempt($credentials, $request->filled('remember')))
        {
            $user = Auth::guard('admin')->user();
            $notification = ['status' =>'success', 'message' => 'Chào mừng, ' . mb_strtoupper($user->name, 'UTF-8') . ' quay lại trang quản trị.'];
            return redirect()->intended(route('admin'))->with($notification);
        }
        return back()->withErrors(['email' => 'Thông tin dăng nhập không đúng hoặc đang tạm khoá.']);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
