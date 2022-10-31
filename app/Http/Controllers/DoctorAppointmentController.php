<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DoctorAppointmentController extends Controller
{
    public function index(User $user)
    {
        //Version 2
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
            ->select('*', 'appointments.id as appointment_id')
            ->orderBy("appointment_id", "ASC")
            ->get();
        return view('doctorappointment.history', compact('user'))->with('list', $list);
    }

    public function accepted(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = $request->status;
        $appointment->save();
        return redirect('/doctorappointment/'.Auth::user()->id)->with('Completed', 'Appointment successfully accepted.');
    }

    public function declined(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = $request->status;
        $appointment->save();
        return redirect('/doctorappointment/'.Auth::user()->id)->with('Completed', 'Appointment successfully declined.');
    }

    public function ongoing(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = $request->status;
        $appointment->save();
        return redirect('/doctorappointment/'.Auth::user()->id)->with('Completed', 'Appointment Status set to Ongoing successfully.');
    }

    public function done(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = $request->status;
        $appointment->save();
        return redirect('/doctorappointment/'.Auth::user()->id)->with('Completed', 'Appointment Status set to Done successfully.');
    }
}
