<?php

namespace App\Console\Commands;

use App\AppointmentReminders\DoctorAppointmentReminder;
use App\AppointmentReminders\PatientAppointmentReminder;
use Illuminate\Console\Command;

class SendReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminders:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminders using Twilio';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $patientAppointmentReminder = new PatientAppointmentReminder();
        $patientAppointmentReminder->sendReminders();

        $doctorAppointmentReminder = new DoctorAppointmentReminder();
        $doctorAppointmentReminder->sendReminders();
    }
}
