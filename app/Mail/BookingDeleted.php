<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Sammyjo20\Wagonwheel\Concerns\SaveForOnlineViewing;

class BookingDeleted extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels, SaveForOnlineViewing;

    public $date;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $date)
    {
        $this->user = $user;
        $this->date = $date;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Bokning borttagen')
            ->from(config('mail.from.address'), $this->user->settings->congregation->name)
            ->replyTo($this->user->email, $this->user->name)
            ->markdown('emails.booking.deleted');
    }
}
