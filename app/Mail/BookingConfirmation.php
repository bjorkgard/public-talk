<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Sammyjo20\Wagonwheel\Concerns\SaveForOnlineViewing;

class BookingConfirmation extends Mailable
{
    use Queueable, SerializesModels, SaveForOnlineViewing;

    public $booking;
    public $calendarLink;
    public $mapLink;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->calendarLink = generateIcs($this->booking);
        $this->mapLink = generateMapLink($this->booking);

        return $this
            ->subject('Bokningsbekräftelse')
            ->from(config('mail.from.address'), $this->booking->user->settings->congregation->name)
            ->replyTo($this->booking->user->email, $this->booking->user->name)
            ->markdown('emails.booking.confirmation');
    }
}
