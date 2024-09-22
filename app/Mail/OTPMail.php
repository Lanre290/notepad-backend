<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Hash;

class OTPMail extends Mailable
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
        // Generate the OTP and extract the user's name
        $otp = mt_rand(1000, 9999);
        $userDetails = session('user_details');
        $userDetails['otp'] = Hash::make($otp);
        session(['user_details' => (array) $userDetails]);
        $name= explode(' ', $this->user['name'])[0];

        // Return the view with the necessary data
        return $this->subject('Verify your Email')
                    ->view('auth.otp')
                    ->with([
                        'otp' => $otp,
                        'name' => $name,
                    ]);
    }
}
