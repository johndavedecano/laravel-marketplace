<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserRegisteredMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * @var App\User $user
     */
    protected $user;

    /**
     * Create a new message instance.
     *
     * @param App\User $user
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.registered')->subject('Account Activation Required')->with([
            'name' => $this->user->name,
            'actionUrl' => route('user.activation', ['token' => $this->user->activation_code])
        ]);
    }
}
