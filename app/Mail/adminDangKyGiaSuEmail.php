<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class adminDangKyGiaSuEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this ->view('email.admin.dangkythanhvien')
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->subject('Đăng ký làm gia sư - ' . config('app.name'));
    }
}
