<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TeamStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $team;
    public $messageType;

    public function __construct($team, $messageType)
    {
        $this->team = $team;
        $this->messageType = $messageType;
    }

    public function build()
    {
        return $this->subject('Team Registration Update')
                    ->view('emails.team_status');
    }
}

