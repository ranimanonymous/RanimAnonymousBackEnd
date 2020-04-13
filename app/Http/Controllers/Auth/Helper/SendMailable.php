<?php

namespace App\Http\Controllers\Auth\Helper;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.name');
    }

    public static function sendEmail($email, $fullName, $verificationcode){

        $subject = config::$email_title;
        $email = $email;


        $data = array(
            'name' => $fullName ,
            'verificationCode' => $verificationcode
        );

        Mail::send('email.name', $data, function($message) use ($email, $subject) {
            $message->to($email)->subject($subject);
        });

    }
}
