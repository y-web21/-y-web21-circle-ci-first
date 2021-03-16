<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendAppMail extends Mailable
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
            ->subject('メール配信テスト')
            ->view('emails.test')
            ->with([
                'url' => $this->verify_url,
            ]);
    }
}
