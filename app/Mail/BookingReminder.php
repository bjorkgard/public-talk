<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingReminder extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    public $mapLink;
    public $calendarLink;

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
        $this->mpaLink = generateMapLink($this->booking);

        return $this
            ->subject('Påminnelse om föreläsning')
            ->from(config('mail.from.address'), $this->booking->user->settings->congregation->name)
            ->replyTo($this->booking->user->email, $this->booking->user->name)
            ->markdown('emails.booking.reminder');
    }
}
