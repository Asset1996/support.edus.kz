<?php
/**
 * MailSender helper handles all staff with mails.
 */
namespace App\Helpers;

use Illuminate\Support\Facades\Mail;

class MailSender
{
    /**
     * URL route of the link.
     */
    protected $route;

    /**
     * Mail template path.
     */
    protected $template;

    public function __construct(string $route, string $template)
    {
        $this->route = $route;
        $this->template = $template;
    }

    /**
     * Array of errors.
     */
    protected $errors = [];

    /**
     * Sends an email with context.
     * @param array $data.
     * 
     * @return bool 
     */
    public function send(array $context){
        try{
            $context['url'] = route($this->route, [
                'lang'=> app()->getLocale(), 
                'token' => $context['verification_token']
            ]);
            $context['template'] = $this->template;
            Mail::to($context['email'])->send(new \App\Mail\VerifyEmail($context));
        }catch(\Swift_TransportException $e){
            $this->errors[] = trans('Error occurred while sending email');
            return False;
        }
        return True;
    }

    /**
     * Cheks if the errors array is empty.
     *
     * @return bool 
     */
    public function hasErrors(){
        return !empty($this->errors);
    }

    /**
     * Returns the first element of the errors array.
     *
     * @return array 
     */
    public function getFirstError(){
        return $this->errors[0];
    }
}