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

class DeleteInactiveDoctor
{
    /**
     * Construct a new DeleteInactiveDoctor
     *
     */
    public function __construct()
    {
        $this->doctors = User::where([
            ['type', '=', 'doctor'],
            ['last_login', '<=', Carbon::now()->subYears(5)],
        ])
            //->orWhereNull('last_login')
            ->get();
    }

    /**
     * Delete each inactive doctor
     *
     * @return void
     */
    public function deleteDoctor()
    {
        $this->doctors->each(
            function ($doctor) {
                $this->deleteRecord($doctor);
            }
        );
    }

    /**
     * Deletes all of Doctor's Records
     *
     * @param Doctor $doctor for each doctor
     *
     * @return void
     */
    private function deleteRecord($doctor)
    {
        //Delete from Users table
        DB::table('users')
            ->where('id', '=', $doctor->id)
            ->delete();

        //Add Logs
        DB::table('inactive_users_logs')
            ->insert([
                'user_id' => $doctor->id,
                'user_email' => $doctor->email,
                'inactive_since' => $doctor->last_login,
            ]);

        //Delete from Doctor Profiles table
        DB::table('doctor_profiles')
            ->where('user_id', '=', $doctor->id)
            ->delete();

        //Delete from DoctorPatient table
        DB::table('doctor_patient')
            ->where('doctor_user_id', '=', $doctor->id)
            ->delete();
    }
}

