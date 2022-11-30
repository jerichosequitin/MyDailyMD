<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\PatientProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DoctorAppointmentController extends Controller
{
    public function index(User $user)
    {
        $dateNow = Carbon::now();
        $dateToday = $dateNow->toDateString();

        $list = DB::table('appointments')
            //Join Users Table if Appointments Patient User ID = User ID
            ->join('users', 'appointments.patient_user_id', '=', 'users.id')

            //Join PatientProfiles Table if User ID = PatientProfiles User ID
            ->join('patient_profiles', 'appointments.patient_id', '=', 'patient_profiles.id')

            //Where Appointment Date = Date Today
            ->whereDate('appointments.date', '=', $dateToday)

            //Where Appointments Doctor User ID should be equal to Current User's ID
            ->where('appointments.doctor_user_id', '=', Auth::user()->id)

            //Where Appointments Status is Accepted or Ongoing
            ->where('appointments.status', '=', 'Accepted')
            ->orWhere('appointments.status', '=', 'Ongoing')

            ->select('*', 'appointments.id as appointment_id')

            ->orderBy('appointments.start', 'ASC')

            ->simplePaginate(4);

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

    public function upcoming(User $user)
    {
        $dateNow = Carbon::now();
        $dateToday = $dateNow->toDateString();

        $list = DB::table('appointments')
            ->join('users', 'appointments.patient_user_id', '=', 'users.id')
            ->join('patient_profiles', 'appointments.patient_id', '=', 'patient_profiles.id')
            ->where('appointments.doctor_user_id', '=', Auth::user()->id)
            ->where('appointments.status', '=', 'Accepted')
            ->where('appointments.date', '>', $dateToday)
            ->select('*', 'appointments.id as appointment_id')
            ->orderBy('appointments.date', 'ASC')
            ->orderBy('appointments.start', 'ASC')
            ->simplePaginate(5);
        return view('doctorappointment.upcoming', compact('user'))->with('list', $list);
    }

    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);

        if($appointment->doctor_user_id == Auth::user()->id)
        {
            return view('doctorappointment.edit', compact('appointment'));
        }
        else
        {
            return redirect()->back()->with('Error', 'This appointment does not belong to you.');
        }
    }

    public function update(Request $request, $id)
    {
        $updateData = $request->validate([
            'meetingLink' => ['required', 'regex:/^((?:https?\:\/\/|www\.)(?:[-a-z0-9]+\.)*[-a-z0-9]+.*)$/'],
        ]);

        Appointment::whereId($id)->update($updateData);
        return redirect('/doctorappointment/upcoming')->with('Completed', 'Appointment Meeting Link successfully updated.');
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

        $dateUnavailable = Appointment::where('doctor_user_id', Auth::user()->id)
            ->where('status', '=', 'Accepted')
            ->where('date', '=', $request->date)
            ->where('start', '<=', $request->end)
            ->where('end', '>=', $request->start)->exists();

        if($linkExists)
        {
            if($linkExistsInactive)
            {
                if($dateUnavailable)
                {
                    return redirect('/doctorappointment/pending')->with('Error', 'You already have an appointment set for the chosen date.');
                }
                else
                {
                    $appointment = Appointment::findOrFail($id);
                    $appointment->status = $request->status;
                    $appointment->meetingLink = $request->meetingLink;
                    $request->validate([
                        'meetingLink' => ['required', 'regex:/^((?:https?\:\/\/|www\.)(?:[-a-z0-9]+\.)*[-a-z0-9]+.*)$/'],
                    ]);
                    $appointment->save();

                    DB::table('doctor_patient')
                        ->where('doctor_user_id', $request->doctor_user_id)
                        ->where('patient_user_id', '=', $request->patient_user_id)
                        ->update([
                            'linkStatus' => 'Active',
                            'updated_at' => \Carbon\Carbon::now()
                        ]);

                    return redirect('/doctorappointment/pending')->with('Completed', 'Appointment successfully accepted. You have regained access to the Patients Health Records.');
                }
            }
            else
            {
                if($dateUnavailable)
                {
                    return redirect('/doctorappointment/pending')->with('Error', 'You already have an appointment set for the chosen date.');
                }
                else
                {
                    $appointment = Appointment::findOrFail($id);
                    $appointment->status = $request->status;
                    $appointment->meetingLink = $request->meetingLink;
                    $request->validate([
                        'meetingLink' => ['required', 'regex:/^((?:https?\:\/\/|www\.)(?:[-a-z0-9]+\.)*[-a-z0-9]+.*)$/'],
                    ]);
                    $appointment->save();

                    return redirect('/doctorappointment/pending')->with('Completed', 'Appointment successfully accepted.');
                }
            }
        }
        else
        {
            if($dateUnavailable)
            {
                return redirect('/doctorappointment/pending')->with('Error', 'You already have an appointment set for the chosen date.');
            }
            else
            {
                $appointment = Appointment::findOrFail($id);
                $appointment->status = $request->status;
                $appointment->meetingLink = $request->meetingLink;
                $request->validate([
                    'meetingLink' => ['required', 'regex:/^((?:https?\:\/\/|www\.)(?:[-a-z0-9]+\.)*[-a-z0-9]+.*)$/'],
                ]);
                $appointment->save();

                DB::table('doctor_patient')
                    ->insert([
                        'doctor_user_id' => $request->doctor_user_id,
                        'doctor_id' => $request->doctor_id,
                        'patient_user_id' => $request->patient_user_id,
                        'patient_id' => $request->patient_id,
                        'linkStatus' => 'Active',
                        'created_at' => \Carbon\Carbon::now()
                    ]);

                return redirect('/doctorappointment/pending')->with('Completed', 'Appointment successfully accepted. You now have access to the Patients Health Records.');
            }
        }

    }

    public function declined(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = $request->status;
        $appointment->save();
        return redirect('/doctorappointment/pending')->with('Completed', 'Appointment successfully declined.');
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
