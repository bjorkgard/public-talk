<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserInvite extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $inviteUrl;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $inviteUrl)
    {
        $this->user = $user;
        $this->inviteUrl = $inviteUrl;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Inbjudan till public-talk')
            ->markdown('emails.user.invite', [
                'user' => $this->user,
                'inviteUrl' => $this->inviteUrl
            ]);
    }
}
