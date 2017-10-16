<?php

namespace UGCore\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use UGCore\Core\Entities\Security\User;

class MailRegisterUser extends Mailable
{
    use Queueable, SerializesModels;
    public $objUser;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $objUser)
    {
        $this->objUser=$objUser;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject('Verifica tu cuenta de correo');
        $this->to($this->objUser->email);
        return $this->markdown('emails.users.register');
    }
}
