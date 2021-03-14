<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccountManage extends Mailable
{
    use Queueable, SerializesModels;

    private $verify_url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($verify_url)
    {
        $this->verify_url = $verify_url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('mail.from.address'))
            ->subject('登録の確認をお願いします')
            ->view('emails.email_verify')
            ->with([
                'url' => $this->verify_url,
            ]);
    }
}
