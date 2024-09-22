<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Hash;

class forgotPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;

    /**
     * Create a new message instance.
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $arr = explode(' ', $this->user['name']);
        $name= count($arr) > 1 ? $arr[1] : $arr[0];
        $id = $this->user->pid;
        $link = route('/forgot-password', ['id' => $id]);

        // Return the view with the necessary data
        return $this->subject('Verify your Email')
                    ->view('auth.forgot-password')
                    ->with([
                        'name' => $name,
                        'link' => $link
                    ]);
    }
}
