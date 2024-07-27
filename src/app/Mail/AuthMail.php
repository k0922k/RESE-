<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AuthMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $url;

    public function __construct($url)
    {
        $this->url = $url;
    }


    public function build()
    {
        return $this->view('mail.tmpRegist')
                    ->subject('【App】仮登録が完了しました')
                    ->with(['url' => $this->url]);
    }
}
