<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendThanksReminder extends Mailable
{
    use Queueable, SerializesModels;

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
            ->from(config('mail.from.address'), $this->booking->settings->congregation->name)
            ->markdown('emails.user.thanks');
    }
}
