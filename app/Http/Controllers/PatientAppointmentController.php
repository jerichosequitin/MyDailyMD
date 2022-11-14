<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\DoctorProfile;
use App\Models\PatientProfile;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PatientAppointmentController extends Controller
{
    public function index(User $user)
    {
        //Version 2
        $list = DB::table('appointments')
            //Join Users Table if Appointments Doctor ID = User ID
            ->join('users', 'appointments.doctor_user_id', '=', 'users.id')

            //Join DoctorProfiles Table if User ID = DoctorProfiles User ID
            ->join('doctor_profiles', 'appointments.doctor_id', '=', 'doctor_profiles.id')


            //Where Appointments Patient User ID should be equal to Current User's ID
            ->where('appointments.patient_user_id', '=', Auth::user()->id)

            //Where Appointments Status is Accepted
            ->where('appointments.status', '=', 'Accepted')

            ->where('appointments.date', '>=', now()->toDateString())

            ->select('*', 'users.id as doctor_user_id')
            ->orderBy("date", "ASC")
            ->orderBy("start", "ASC")

            ->simplePaginate(4);
        return view('patientappointment.index', compact('user'))->with('list', $list);
    }

    public function pending(User $user)
    {
        $list = DB::table('appointments')
            ->join('users', 'appointments.doctor_user_id', '=', 'users.id')
            ->join('doctor_profiles', 'appointments.doctor_id', '=', 'doctor_profiles.id')
            ->where('appointments.patient_user_id', '=', Auth::user()->id)
            ->where('appointments.status', '=', 'Pending')
            ->select('*', 'appointments.id as appointment_id')
            ->get();

        return view('patientappointment.pending', compact('user'))->with('list', $list);
    }

    public function edit($id)
    {
        $doctor = DB::table('appointments')
            ->join('users', 'appointments.doctor_user_id', '=', 'users.id')
            ->join('doctor_profiles', 'appointments.doctor_id', '=', 'doctor_profiles.id')
            ->where('appointments.patient_user_id', '=', Auth::user()->id)
            ->where('appointments.id', '=', $id)
            ->get();

        $appointment = Appointment::findOrFail($id);

        if($appointment->patient_user_id == Auth::user()->id)
        {
            return view('patientappointment.edit', compact('appointment'))->with('doctor', $doctor);
        }
        else
        {
            return redirect()->back()->with('Error', 'This appointment does not belong to you.');
        }
    }

    public function update(Request $request, $id)
    {
        $oneMonthFromNow = Carbon::now()->addDays(31)->toDateString();

        $appointment = DB::table('appointments')
            ->where('patient_user_id', '=', Auth::user()->id)
            ->where('id', '=', $id)
            ->first();

        $doctorDateUnavailable = Appointment::where('doctor_id', $request->doctor_id)
            ->where('status', '=', 'Accepted')
            ->where('date', '=', $request->date)
            ->where('start', '<=', $request->end)
            ->where('end', '>=', $request->start)->exists();

        $patientDateUnavailable = Appointment::where('patient_id', $request->patient_id)
            ->where('status', '=', 'Accepted')
            ->where('date', '=', $request->date)
            ->where('start', '<=', $request->end)
            ->where('end', '>=', $request->start)->exists();

        if($appointment->status != 'Pending')
        {
            return redirect('/patientappointment/pending')->with('Error', 'This appointment cannot be updated because it is no longer pending.');
        }
        else
        {
            if($doctorDateUnavailable)
            {
                return redirect()->back()->with('Error', 'Doctor is not available for the chosen date.');
            }
            elseif($patientDateUnavailable)
            {
                return redirect()->back()->with('Error', 'You already have an appointment set for the chosen date.');
            }
            else
            {
                $doctor = DB::table('appointments')
                    ->join('users', 'appointments.doctor_user_id', '=', 'users.id')
                    ->join('doctor_profiles', 'appointments.doctor_id', '=', 'doctor_profiles.id')
                    ->where('appointments.patient_user_id', '=', Auth::user()->id)
                    ->where('appointments.id', '=', $id)
                    ->select('*', 'doctor_profiles.id as doctor_id')
                    ->first();

                $doctorWorkingHoursStart = Carbon::parse($doctor->workingHoursStart);
                $doctorWorkingHoursEnd = Carbon::parse($doctor->workingHoursEnd);

                $updateData = request()->validate([
                    'date' => 'required|after:7 days|before:'.$oneMonthFromNow,
                    'start' => 'required|after:'.$doctor->workingHoursStart,
                    'end' => 'required|after:start|before:'.$doctor->workingHoursEnd,
                ],
                [
                    'date.after' => 'Date should be after 7 days.',
                    'date.before' => 'Date should be within a month from now.',
                    'start.after' => 'Appointment Start should be after '.$doctorWorkingHoursStart->format('h:i A'),
                    'end.after' => 'Appointment End should be after Appointment Start.',
                    'end.before' => 'Appointment End should be before '.$doctorWorkingHoursEnd->format('h:i A'),
                ]);

                Appointment::whereId($id)->update($updateData);
                return redirect('/patientappointment/pending')->with('Completed', 'Appointment details successfully updated.');
            }
        }
    }

    public function cancel(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = $request->status;
        $appointment->save();
        return redirect('/patientappointment/pending')->with('Completed', 'Appointment successfully cancelled.');
    }

    public function linked(User $user)
    {
        $list = DB::table('doctor_patient')
            ->join('users', 'doctor_patient.doctor_user_id', '=', 'users.id')
            ->join('doctor_profiles', 'doctor_patient.doctor_user_id', '=', 'doctor_profiles.user_id')
            ->where('doctor_patient.patient_user_id', '=', Auth::user()->id)
            ->where('doctor_patient.linkStatus', '=', 'Active')

            ->select('*', 'doctor_profiles.id as doctor_id')
            ->orderBy('doctor_patient.updated_at', 'DESC')
            ->simplePaginate(4);

        return view('patientappointment.linked', compact('user'))->with('list', $list);
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

        $unattendedAppointment = Appointment::where([
            ['doctor_user_id', '=', $request->doctor_user_id],
            ['patient_user_id', '=', $request->patient_user_id],
            ['status', '=', 'Accepted'],
            ['date', '<', Carbon::now()->toDateString()],
        ])->exists();

        if($existingAppointment)
        {
            if($unattendedAppointment)
            {
                DB::table('doctor_patient')
                    ->where('doctor_user_id', $request->doctor_user_id)
                    ->where('patient_user_id', '=', Auth::user()->id)
                    ->update([
                        'linkStatus' => 'Inactive',
                        'updated_at' => \Carbon\Carbon::now()
                    ]);

                    return redirect('/patientappointment/linked')->with('Completed', 'Link Status with Doctor set to Inactive. Your Health Records are no longer accessible to them.');
            }
            else
            {
                return redirect('/patientappointment/linked')->with('Error', 'You have an upcoming appointment with the Doctor. Cannot set Link Status to Inactive.');
            }
        }
        else
        {
            DB::table('doctor_patient')
                ->where('doctor_user_id', $request->doctor_user_id)
                ->where('patient_user_id', '=', Auth::user()->id)
                ->update([
                    'linkStatus' => 'Inactive',
                    'updated_at' => \Carbon\Carbon::now()
                ]);

            return redirect('/patientappointment/linked')->with('Completed', 'Link Status with Doctor set to Inactive. Your Health Records are no longer accessible to them.');
        }
    }

    public function doctorProfile($id)
    {
        $linkExists = DB::table('doctor_patient')
            ->where('doctor_id', '=', $id)
            ->where('patient_user_id', '=', Auth::user()->id)
            ->exists();

        $link = DB::table('doctor_patient')
            ->where('doctor_id', '=', $id)
            ->where('patient_user_id', '=', Auth::user()->id)
            ->first();

        if($linkExists)
        {

            if($link->linkStatus == 'Active')
            {
                $doctorProfile = DoctorProfile::findOrFail($id);
                return view('patientappointment.doctorprofile', compact('doctorProfile'));
            }
            else
            {
                return redirect()->back()->with('Error', 'Link Status with Patient is Inactive. Cannot access Health Records.');
            }
        }
        else
        {
            return redirect()->back()->with('Error', 'You are not linked to the Patient. Cannot access Health Records.');
        }
    }

    public function history(User $user)
    {
        $list = DB::table('appointments')
            ->join('users', 'appointments.doctor_user_id', '=', 'users.id')
            ->join('doctor_profiles', 'appointments.doctor_id', '=', 'doctor_profiles.id')
            ->where('appointments.patient_user_id', '=', Auth::user()->id)
            ->select('*', 'appointments.id as appointment_id')
            ->orderBy("appointment_id", "DESC")
            ->simplePaginate(5);
        return view('patientappointment.history', compact('user'))->with('list', $list);
    }

    public function search()
    {
        $doc = DB::table('users')
            ->join('doctor_profiles', 'users.id', '=', 'doctor_profiles.user_id')
            ->where('type', '=', 'doctor')
            ->where('isVerified', '=', 'Enabled')
            ->select('*', 'users.id as doctor_user_id')
            ->orderBy('doctor_profiles.specialization', 'ASC')
            ->orderBy('doctor_profiles.workingHoursStart', 'ASC')
            ->simplePaginate(5);

        return view ('patientappointment.search')->with('doc', $doc);
    }

    public function book($id)
    {
        $doctorProfile = DoctorProfile::findOrFail($id);
        $oneMonthFromNow = Carbon::now()->addDays(31);

        $list = DB::table('appointments')
            ->join('users', 'appointments.doctor_user_id', '=', 'users.id')
            ->join('doctor_profiles', 'appointments.doctor_id', '=', 'doctor_profiles.id')
            ->where('appointments.doctor_user_id', '=', $doctorProfile->user->id)
            ->where('appointments.status', '=', 'Accepted')
            ->whereDate('appointments.date', '>=', Carbon::now()->addDay())
            ->whereDate('appointments.date', '<=', $oneMonthFromNow)
            ->select('*', 'users.id as doctor_user_id')
            ->orderBy('appointments.date', 'ASC')
            ->orderBy('appointments.start', 'ASC')
            ->get();

        if($doctorProfile->isVerified == 'Enabled')
        {
            return view('patientappointment.book', compact('doctorProfile'))->with('list', $list);
        }
        else
        {
            return redirect()->back()->with('Error', 'Doctor is not yet verified.');
        }
    }

    public function store(Request $request)
    {
        $oneMonthFromNow = Carbon::now()->addDays(31)->toDateString();

        $doctorDateUnavailable = Appointment::where('doctor_id', $request->doctor_id)
            ->where('status', '=', 'Accepted')
            ->where('date', '=', $request->date)
            ->where('start', '<=', $request->end)
            ->where('end', '>=', $request->start)->exists();

        $patientDateUnavailable = Appointment::where('patient_id', $request->patient_id)
            ->where('status', '=', 'Accepted')
            ->where('date', '=', $request->date)
            ->where('start', '<=', $request->end)
            ->where('end', '>=', $request->start)->exists();

        $patientOneRequest = Appointment::where([
            ['patient_id', '=', $request->patient_id],
            ['doctor_id', '=', $request->doctor_id],
            ['status', '!=', 'Done'],
            ['status', '!=', 'Cancelled'],
            ['status', '!=', 'Declined']
        ])->exists();

        $patientPending = Appointment::where('patient_id', $request->patient_id)
            ->where('status', '=', 'Pending')->get();

        $patientPendingCount = count($patientPending);

        $doctorPending = Appointment::where('doctor_id', $request->doctor_id)
            ->where('status', '=', 'Pending')->get();

        $doctorPendingCount = count($doctorPending);


        if($doctorDateUnavailable)
        {
            return redirect()->back()->with('Error', 'Doctor is not available for the chosen date.');
        }
        elseif($patientDateUnavailable)
        {
            return redirect()->back()->with('Error', 'You already have an appointment set for the chosen date.');
        }
        elseif ($patientOneRequest)
        {
            return redirect()->back()->with('Error', 'You already have a pending appointment request with the chosen doctor. You can only have 1 at a time.');
        }
        elseif ($patientPendingCount >= 5)
        {
            return redirect('patientappointment/list')->with('Error', 'You can only have up to 5 pending appointment requests at a time.');
        }
        elseif ($doctorPendingCount >= 5)
        {
            return redirect('patientappointment/list')->with('Error', 'Doctor has too many pending requests at the moment. Please try again later.');
        }
        else {
            $doctorWorkingHoursStart = Carbon::parse($request->workingHoursStart);
            $doctorWorkingHoursEnd = Carbon::parse($request->workingHoursEnd);

            $storeData = $request->validate([
                'patient_user_id' => 'required',
                'patient_id' => 'required',
                'patient_email' => 'required',
                'doctor_user_id' => 'required',
                'doctor_id' => 'required',
                'doctor_email' => 'required',
                'date' => 'required|after:7 days|before:'.$oneMonthFromNow,
                'start' => 'required|after:'.$request->workingHoursStart,
                'end' => 'required|after:start|before:'.$request->workingHoursEnd,
                'status' => 'required',
            ],
                [
                    'date.after' => 'Date should be after 7 days.',
                    'date.before' => 'Date should be within a month from now.',
                    'start.after' => 'Appointment Start should be after '.$doctorWorkingHoursStart->format('h:i A'),
                    'end.after' => 'Appointment End should be after Appointment Start.',
                    'end.before' => 'Appointment End should be before '.$doctorWorkingHoursEnd->format('h:i A'),
                ]);

            $appointment = Appointment::create($storeData);
            return redirect('patientappointment/list')->with('Completed', 'Appointment requested successfully. Please wait for the chosen doctor to accept.');
        }
    }
}
