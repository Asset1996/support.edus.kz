<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MessageSentNotifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $sender;
    public $url;
    public $message;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $sender, string $url, string $message)
    {
        $this->sender = $sender;
        $this->url = $url;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.MessageSent');
    }
}
