<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;

class MailSender
{
    /**
     * Sends an email with cerification link after registration.
     * @param string $email - Email addess of registrated person.
     * 
     * @return bool 
     */
    public static function sendVerificationLinkToEmail(array $data){
        try{
            $url = route('verify-email', ['lang'=> app()->getLocale(), 'token' => $data['verification_token']]);
            Mail::to($data['email'])->send(new VerifyEmail($data['name'], $url));
        }catch(\Swift_TransportException $e){
            return False;
        }
        return True;
    } 
}