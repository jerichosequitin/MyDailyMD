<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Immunization;
use App\Models\MedicalHistory;
use App\Models\PatientProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DoctorManageHealthRecordsController extends Controller
{
    public function index(User $user)
    {
        $list = DB::table('doctor_patient')
            ->join('users', 'doctor_patient.patient_user_id', '=', 'users.id')
            ->join('patient_profiles', 'doctor_patient.patient_user_id', '=', 'patient_profiles.user_id')
            ->where('doctor_patient.doctor_user_id', '=', Auth::user()->id)
            ->where('doctor_patient.linkStatus', '=', 'Active')

            ->select('*', 'patient_profiles.id as patient_id')
            ->orderBy('doctor_patient.updated_at', 'DESC')
            ->simplePaginate(4);

        return view('doctormanagehealthrecords.index', compact('user'))->with('list', $list);
    }

    public function inactive(Request $request)
    {
        $existingAppointment = Appointment::where([
            ['doctor_user_id', '=', $request->doctor_user_id],
            ['patient_user_id', '=', $request->patient_user_id],
            ['status', '!=', 'Done'],
            ['status', '!=', 'Cancelled'],
            ['status', '!=', 'Declined'],
            ['status', '!=', 'Pending']
        ])->exists();

        if($existingAppointment)
        {
            return redirect('/doctormanagehealthrecords')->with('Error', 'You have an upcoming appointment with the Patient. Cannot set Link Status to Inactive.');
        }
        else
        {
            DB::table('doctor_patient')
                ->where('doctor_user_id', Auth::user()->id)
                ->where('patient_user_id', '=', $request->patient_user_id)
                ->update([
                    'linkStatus' => 'Inactive',
                    'updated_at' => \Carbon\Carbon::now()
                ]);

            return redirect('/doctormanagehealthrecords')->with('Completed', 'Link Status with Patient set to Inactive. You can no longer access their Health Records.');
        }

    }

    public function profile($id)
    {
        $patientProfile = PatientProfile::findOrFail($id);
        return view('doctormanagehealthrecords.profile', compact('patientProfile'));
    }

    public function medicalHistory($id)
    {
        $patientProfile = PatientProfile::findOrFail($id);

        $medicalHistory = MedicalHistory::where('user_id','=',$patientProfile->user_id)->get();
        return view('doctormanagehealthrecords.medicalhistory', compact ('patientProfile','medicalHistory'));
    }

    public function immunization($id)
    {
        $patientProfile = PatientProfile::findOrFail($id);

        $immunization = Immunization::where('user_id','=',$patientProfile->user_id)->get();
        return view('doctormanagehealthrecords.immunization', compact ('patientProfile','immunization'));
    }
}
