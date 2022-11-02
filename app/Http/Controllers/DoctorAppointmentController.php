<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\PatientProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DoctorAppointmentController extends Controller
{
    public function index(User $user)
    {
        $list = DB::table('appointments')
            //Join Users Table if Appointments Doctor ID = User ID
            ->join('users', 'appointments.patient_user_id', '=', 'users.id')

            //Join DoctorProfiles Table if User ID = DoctorProfiles User ID
            ->join('patient_profiles', 'appointments.patient_id', '=', 'patient_profiles.id')


            //Where Appointments Patient User ID should be equal to Current User's ID
            ->where('appointments.doctor_user_id', '=', Auth::user()->id)

            //Where Appointments Status is Accepted
            ->where('appointments.status', '=', 'Accepted')
            ->orWhere('appointments.status', '=', 'Ongoing')

            ->where('date', '=', Carbon::today())

            ->select('*', 'appointments.id as appointment_id')

            ->get();

        return view('doctorappointment.index', compact('user'))->with('list', $list);
    }

    public function pending(User $user)
    {
        $list = DB::table('appointments')
            ->join('users', 'appointments.patient_user_id', '=', 'users.id')
            ->join('patient_profiles', 'appointments.patient_id', '=', 'patient_profiles.id')
            ->where('appointments.doctor_user_id', '=', Auth::user()->id)
            ->where('appointments.status', '=', 'Pending')
            ->select('*', 'appointments.id as appointment_id')
            ->get();
        return view('doctorappointment.pending', compact('user'))->with('list', $list);
    }

    public function history(User $user)
    {
        $list = DB::table('appointments')
            ->join('users', 'appointments.patient_user_id', '=', 'users.id')
            ->join('patient_profiles', 'appointments.patient_id', '=', 'patient_profiles.id')
            ->where('appointments.doctor_user_id', '=', Auth::user()->id)
            ->where('appointments.status', '!=', 'Cancelled')
            ->select('*', 'appointments.id as appointment_id')
            ->orderBy("appointment_id", "DESC")
            ->simplePaginate(5);
        return view('doctorappointment.history', compact('user'))->with('list', $list);
    }

    public function accepted(Request $request, $id)
    {
        $linkExists = DB::table('doctor_patient')
            ->where('doctor_user_id', $request->doctor_user_id)
            ->where('patient_user_id', '=', $request->patient_user_id)->exists();

        $linkExistsInactive = DB::table('doctor_patient')
            ->where('doctor_user_id', $request->doctor_user_id)
            ->where('patient_user_id', '=', $request->patient_user_id)
            ->where('linkStatus', '=', 'Inactive')->exists();


        if($linkExists)
        {
            if($linkExistsInactive)
            {
                $appointment = Appointment::findOrFail($id);
                $appointment->status = $request->status;
                $appointment->save();

                DB::table('doctor_patient')
                    ->where('doctor_user_id', $request->doctor_user_id)
                    ->where('patient_user_id', '=', $request->patient_user_id)
                    ->update([
                        'linkStatus' => 'Active',
                        'updated_at' => \Carbon\Carbon::now()
                    ]);

                return redirect('/doctorappointment/list')->with('Completed', 'Appointment successfully accepted. You have regained access to the Patients Health Records.');
            }
            else
            {
                $appointment = Appointment::findOrFail($id);
                $appointment->status = $request->status;
                $appointment->save();

                return redirect('/doctorappointment/list')->with('Completed', 'Appointment successfully accepted.');
            }
        }
        else
        {
            $appointment = Appointment::findOrFail($id);
            $appointment->status = $request->status;
            $appointment->save();

            DB::table('doctor_patient')
                ->insert([
                    'doctor_user_id' => $request->doctor_user_id,
                    'patient_user_id' => $request->patient_user_id,
                    'linkStatus' => 'Active',
                    'created_at' => \Carbon\Carbon::now()
                ]);

            /*$patient = PatientProfile::findOrFail($request->patient_user_id);
            $doctorData = $request->validate([
                'doctor_user_id' => 'required',
            ]);

            $patient->doctors()->attach($doctorData);*/

            return redirect('/doctorappointment/list')->with('Completed', 'Appointment successfully accepted. You now have access to the Patients Health Records.');
        }

    }

    public function declined(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = $request->status;
        $appointment->save();
        return redirect('/doctorappointment/list')->with('Completed', 'Appointment successfully declined.');
    }

    public function ongoing(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = $request->status;
        $appointment->save();
        return redirect('/doctorappointment/list')->with('Completed', 'Appointment Status set to Ongoing successfully.');
    }

    public function done(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = $request->status;
        $appointment->save();
        return redirect('/doctorappointment/list')->with('Completed', 'Appointment Status set to Done successfully.');
    }
}
