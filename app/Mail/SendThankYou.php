<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Sammyjo20\Wagonwheel\Concerns\SaveForOnlineViewing;

class SendThankYou extends Mailable
{
    use Queueable, SerializesModels, SaveForOnlineViewing;

    public $booking;
    public $greeting;

    /**
     * Create a new message instance.
     *
     * @param Booking $booking
     * @param string $greeting
     * @return void
     */
    public function __construct(Booking $booking, $greeting)
    {
        $this->booking = $booking;
        $this->greeting = $greeting;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Tack för din föreläsning')
            ->from(config('mail.from.address'), $this->booking->user->settings->congregation->name)
            ->markdown('emails.speaker.thank_you');
    }
}
