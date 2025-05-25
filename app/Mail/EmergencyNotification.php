<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Emergency;

class EmergencyNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $emergency;

    public function __construct(Emergency $emergency)
    {
        $this->emergency = $emergency;
    }

    public function build()
    {
        return $this->subject('New Emergency Alert')
            ->view('emails.emergency_notification');
    }
}
