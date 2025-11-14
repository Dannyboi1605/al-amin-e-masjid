<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Volunteer;

class VolunteerStatusChanged extends Mailable
{
    use Queueable, SerializesModels;

    public $volunteer;

    public function __construct(Volunteer $volunteer)
    {
        $this->volunteer = $volunteer;
    }

    public function build()
    {
        return $this->subject('Volunteer application status updated')
                    ->view('emails.volunteer_status_changed');
    }
}
