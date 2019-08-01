<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DangkyHocEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $request;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this ->view('email.dangkyhoc')
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->subject('Đăng ký tìm gia sư - ' . config('app.name'))
            ->with(['hoten' => $this->request['hoten']]);
    }
}
