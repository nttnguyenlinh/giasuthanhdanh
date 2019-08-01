<?php
use Illuminate\Support\Facades\Artisan;
/*

php artisan cache:clear
php artisan route:clear
php artisan config:clear
php artisan config:cache
php artisan view:clear

*/

Route::get('clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    echo "<h3 style='color: #2ae9aa;'>Hệ thống đã được giải phóng và tối ưu!</h3>";
});

Auth::routes([
    'verify' => true,
    'reset' => true
]);

Route::match(['get', 'post'], 'register', function () {
    abort(404);
});

Route::prefix('/')->group(function() {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('kiem-tra-cmnd', 'HomeController@kiemtra_cmnd')->name('kiemtra_cmnd');

    Route::get('thong-tin-lien-he', 'LienHeController@index')->name('lienhe');
    Route::get('noi-quy-nhan-lop', 'NoiQuyController@index')->name('noiquy');
    Route::get('hoc-phi-tham-khao', 'HocPhiController@index')->name('hocphi');
    Route::get('tai-lieu-hoc-tap', 'TaiLieuController@index')->name('tailieu');
    Route::get('tai-lieu/{slug}', 'TaiLieuController@chitiet')->name('chitiettailieu');
    Route::get('tin-tuc', 'TinTucController@index')->name('tintuc');
    Route::get('tin-tuc/{slug}', 'TinTucController@chitiet')->name('chitiettintuc');
    Route::resource('dang-ky-tim-gia-su', 'DangKyHocController')->only(['index', 'store']);
    Route::resource('dang-ky-lam-gia-su', 'DangKyGiaSuController')->only(['index', 'store']);

    Route::get('danh-sach-lop-hien-co', 'DanhSachLopController@index')->name('danhsachlop');
    Route::post('danh-sach-lop-hien-co', 'DanhSachLopController@timkiemlop')->name('timkiemlop');

    Route::get('danh-sach-gia-su', 'DanhSachGiaSuController@index')->name('danhsachgiasu');
    Route::post('danh-sach-gia-su', 'DanhSachGiaSuController@timkiemgiasu')->name('timkiemgiasu');

    Route::get('gia-su-{slug}', 'DanhSachLopController@chitietlop')->name('chitietlop');
    Route::post('gia-su-{slug}', 'DanhSachLopController@dangkyday')->name('dangkyday');

    Route::get('d', function () {
        return redirect()->route('admin');
    });
});

Route::prefix('giasu')->group(function() {
    Route::get('/', 'GiaSuController@index')->name('giasu');
    Route::post('cap-nhat-thong-tin', 'GiaSuController@store')->name('giasu.store');
    Route::get('thay-doi-mat-khau', 'GiaSuController@dmk')->name('giasu.dmk');
    Route::post('thay-doi-mat-khau', 'GiaSuController@tdmk')->name('giasu.tdmk');
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('giasu.login');
    Route::post('login', 'Auth\LoginController@login')->name('giasu.login.submit');
    Route::prefix('password')->group(function() {
        Route::post('email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        Route::get('reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::get('reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('reset', 'Auth\ResetPasswordController@reset')->name('password.update');
    });
    Route::prefix('email')->group(function() {
        Route::post('resend', 'Auth\VerificationController@resend')->name('verification.resend');
        Route::get('verify', 'Auth\VerificationController@show')->name('verification.notice');
        Route::get('verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
    });
});

Route::prefix('admin')->group(function() {
    Route::get('/', 'AdminController@index')->name('admin');
    Route::get('login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

    Route::prefix('password')->group(function() {
        Route::post('email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
        Route::get('reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
        Route::get('reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
        Route::post('reset', 'Auth\AdminResetPasswordController@reset')->name('admin.password.update');
    });
    Route::prefix('email')->group(function() {
        Route::post('resend', 'Auth\AdminVerificationController@resend')->name('admin.verification.resend');
        Route::get('verify', 'Auth\AdminVerificationController@show')->name('admin.verification.notice');
        Route::get('verify/{id}', 'Auth\AdminVerificationController@verify')->name('admin.verification.verify');
    });

    Route::prefix('nguoi-dung')->group(function() {
        Route::get('/', 'AdminController@nguoidung')->name('admin.nguoidung');
        Route::get('danh-sach', 'AdminController@ds_nguoidung')->name('admin.ds_nguoidung');
        Route::post('them', 'AdminController@them_nguoidung')->name('admin.them_nguoidung');
        Route::post('thay-doi', 'AdminController@thaydoi_nguoidung')->name('admin.thaydoi_nguoidung');
        Route::delete('xoa', 'AdminController@xoa_nguoidung')->name('admin.xoa_nguoidung');
    });

    Route::prefix('gia-su')->group(function() {
        Route::get('/', 'AdminController@giasu')->name('admin.giasu');
        Route::get('danh-sach', 'AdminController@ds_giasu')->name('admin.ds_giasu');
        Route::post('thay-doi', 'AdminController@thaydoi_giasu')->name('admin.thaydoi_giasu');
        Route::get('lay-thong-tin', 'AdminController@laythongtin_giasu')->name('admin.laythongtin_giasu');
        Route::delete('xoa', 'AdminController@xoa_giasu')->name('admin.xoa_giasu');
    });

    Route::prefix('danh-sach-dang-ky')->group(function() {
        Route::get('/', 'AdminController@dangky')->name('admin.dangky');
        Route::get('danh-sach', 'AdminController@ds_dangky')->name('admin.ds_dangky');
        Route::post('thay-doi', 'AdminController@thaydoi_dangky')->name('admin.thaydoi_dangky');
        Route::get('kiem-tra-ma-lop', 'AdminController@kiemtra_malop')->name('admin.kiemtra_malop');
        Route::get('lay-thong-tin', 'AdminController@laythongtin_dangky')->name('admin.laythongtin_dangky');
        Route::delete('xoa', 'AdminController@xoa_dangky')->name('admin.xoa_dangky');
    });

    Route::prefix('danh-sach-lop')->group(function() {
        Route::get('/', 'AdminController@lop')->name('admin.dslop');
        Route::get('danh-sach', 'AdminController@ds_lop')->name('admin.ds_molop');
        Route::post('thay-doi', 'AdminController@thaydoi_dslop')->name('admin.thaydoi_dslop');
        Route::get('lay-thong-tin', 'AdminController@laythongtin_dslop')->name('admin.laythongtin_dslop');
        Route::post('cap-nhat', 'AdminController@capnhat_dslop')->name('admin.capnhat_dslop');
        Route::delete('xoa', 'AdminController@xoa_dslop')->name('admin.xoa_dslop');
    });

    Route::prefix('danh-sach-nhan-day')->group(function() {
        Route::get('/', 'AdminController@nhanday')->name('admin.dsnhanday');
        Route::get('lay-thong-tin', 'AdminController@laythongtin_nhanday')->name('admin.laythongtin_nhanday');
        Route::post('thay-doi', 'AdminController@thaydoi_nhanday')->name('admin.thaydoi_nhanday');
        Route::post('thay-doi-gia-su', 'AdminController@thaydoigs_nhanday')->name('admin.thaydoigs_nhanday');
        Route::delete('xoa', 'AdminController@xoa_nhanday')->name('admin.xoa_nhanday');
    });

    Route::prefix('bai-viet')->group(function() {
        Route::get('/', 'AdminController@baiviet')->name('admin.baiviet');
        Route::get('danh-sach', 'AdminController@ds_baiviet')->name('admin.ds_baiviet');
        Route::get('them', 'AdminController@baiviet_them')->name('admin.baiviet_them');
        Route::post('them', 'AdminController@baiviet_luu')->name('admin.baiviet_luu');
        Route::get('xem/{id}', 'AdminController@baiviet_xem')->name('admin.baiviet_xem');
        Route::post('xem', 'AdminController@baiviet_xem_luu')->name('admin.baiviet_xem_luu');
        Route::delete('xoa', 'AdminController@baiviet_xoa')->name('admin.baiviet_xoa');
    });

    Route::prefix('media')->group(function() {
        Route::get('/', 'AdminController@media')->name('admin.media');
        Route::get('explorer', function () {
            return view('admin.media.explorer');
        });
    });

    Route::prefix('tools')->group(function() {
        Route::get('/', 'AdminController@tools')->name('admin.tools');
        Route::post('/', 'AdminController@tools_thaydoi')->name('admin.tools.thaydoi');
        Route::get('kiem-tra-sdt', 'AdminController@kiemtra_sdt')->name('admin.kiemtra_sodt');
        Route::get('kiem-tra-email', 'AdminController@kiemtra_email')->name('admin.kiemtra_email');
        Route::get('kiem-tra-cmnd', 'AdminController@kiemtra_cmnd')->name('admin.kiemtra_cmnd');
    });
});