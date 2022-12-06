<?php

namespace App\DeleteInactive;

use App\Models\Appointment;
use App\Models\DoctorProfile;
use App\Models\PatientProfile;
use App\Models\User;
use Illuminate\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Twilio\Rest\Client;

class DeleteInactivePatient
{
    /**
     * Construct a new DeleteInactivePatient
     *
     */
    public function __construct()
    {
        $this->patients = User::where([
            ['type', '=', 'patient'],
            ['last_login', '<=', Carbon::now()->subYears(5)],
        ])
            //->orWhereNull('last_login')
            ->get();
    }

    /**
     * Delete each inactive patient
     *
     * @return void
     */
    public function deletePatient()
    {
        $this->patients->each(
            function ($patient) {
                $this->deleteRecord($patient);
            }
        );
    }

    /**
     * Deletes all of Patient's Records
     *
     * @param Patient $patient for each patient
     *
     * @return void
     */
    private function deleteRecord($patient)
    {
        //Delete from Users table
        DB::table('users')
            ->where('id', '=', $patient->id)
            ->delete();

        //Add Logs
        DB::table('inactive_users_logs')
            ->insert([
                'user_id' => $patient->id,
                'user_email' => $patient->email,
                'inactive_since' => $patient->last_login,
            ]);

        //Delete from Patient Profiles table
        DB::table('patient_profiles')
            ->where('user_id', '=', $patient->id)
            ->delete();

        //Delete from DoctorPatient table
        DB::table('doctor_patient')
            ->where('patient_user_id', '=', $patient->id)
            ->delete();

        //Delete Health Records
        DB::table('medical_histories')
            ->where('user_id', '=', $patient->id)
            ->delete();
        DB::table('medications')
            ->where('user_id', '=', $patient->id)
            ->delete();
        DB::table('allergies')
            ->where('user_id', '=', $patient->id)
            ->delete();
        DB::table('progress_notes')
            ->where('user_id', '=', $patient->id)
            ->delete();
        DB::table('immunizations')
            ->where('user_id', '=', $patient->id)
            ->delete();
    }
}

