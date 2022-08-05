<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Users name.
     */
    public $name;

    /**
     * Url link to activate the accout.
     */
    public $url;

    /**
     * Url link to activate the accout.
     */
    public $password;

    /**
     * Template path.
     */
    public $template;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $context)
    {
        foreach($context as $key => $value){
            $this->$key = $value;
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown($this->template);
    }
}
