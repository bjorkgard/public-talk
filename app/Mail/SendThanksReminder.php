<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Sammyjo20\Wagonwheel\Concerns\SaveForOnlineViewing;

class SendThanksReminder extends Mailable
{
    use Queueable, SerializesModels, SaveForOnlineViewing;

    public $booking;
    public $bookingLink;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
        $this->bookingLink = route('bookings.thanks', ['identifier' => $booking->identifier]);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Påminnelse om att tacka talare')
            ->from(config('mail.from.address'), $this->booking->user->settings->congregation->name)
            ->markdown('emails.user.thanks');
    }
}
