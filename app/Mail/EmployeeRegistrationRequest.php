<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmployeeRegistrationRequest extends Mailable
{
    use Queueable, SerializesModels;

    public $employeeRequest;

    public function __construct($employeeRequest)
    {
        $this->employeeRequest = $employeeRequest;
    }

    public function build()
    {
        return $this->subject('New Employee Registration Request')
                    ->view('emails.employee_registration_request');
    }
}
