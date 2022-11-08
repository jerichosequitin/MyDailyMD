<?php

namespace App\AppointmentReminders;

use App\Models\Appointment;
use App\Models\DoctorProfile;
use App\Models\PatientProfile;
use App\Models\User;
use Illuminate\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Twilio\Rest\Client;

class PatientAppointmentReminder
{
    /**
     * Construct a new PatientAppointmentReminder
     *
     * @param Illuminate\Support\Collection $twilioClient The client to use to query the API
     */
    public function __construct()
    {
        $dateNow = Carbon::now();
        $dateToday = $dateNow->toDateString();

        $this->appointments = Appointment::where('date', '=', $dateToday)
            ->where('status', '=', 'Accepted')
            ->get();

        $twilioConfig =\Config::get('services.twilio');
        $accountSid = $twilioConfig['twilio_account_sid'];
        $authToken = $twilioConfig['twilio_auth_token'];
        $this->sendingNumber = $twilioConfig['twilio_number'];

        $this->twilioClient = new Client($accountSid, $authToken);
    }

    /**
     * Send reminders for each appointment
     *
     * @return void
     */
    public function sendReminders()
    {
        $this->appointments->each(
            function ($appointment) {
                $this->_remindAbout($appointment);
            }
        );
    }

    /**
     * Sends a message for an appointment
     *
     * @param Appointment $appointment The appointment to remind
     *
     * @return void
     */
    private function _remindAbout($appointment)
    {
        //Get Patient
        $patient = DB::table('appointments')
            ->where('appointments.patient_user_id', '=', $appointment->patient_user_id)
            ->first();
        $patientCredential = User::where('id', '=', $patient->patient_user_id)
            ->first();
        $patientInfo = PatientProfile::where('user_id', '=', $patient->patient_user_id)
            ->first();

        //Get Doctor
        $doctor = DB::table('appointments')
            ->where('doctor_user_id', '=', $appointment->doctor_user_id)
            ->first();
        $doctorCredential = User::where('id', '=', $doctor->doctor_user_id)
            ->first();
        $doctorInfo = DoctorProfile::where('user_id', '=', $doctor->doctor_user_id)
            ->first();

        $patientName = $patientCredential->name;
        $doctorName = $doctorCredential->name;
        $time = Carbon::parse($appointment->start)
            ->format('h:i A');

        $message = "Hello $patientName, this is a reminder that you have an appointment with Dr. $doctorName today at $time!";
        $this->_sendMessage('+63'.$patientInfo->mobileNumber, $message);
    }

    /**
     * Sends a single message using the app's global configuration
     *
     * @param string $number  The number to message
     * @param string $content The content of the message
     *
     * @return void
     */
    private function _sendMessage($number, $content)
    {
        $this->twilioClient->messages->create(
            $number,
            array(
                "from" => $this->sendingNumber,
                "body" => $content
            )
        );
    }
}

