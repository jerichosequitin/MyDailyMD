<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\DoctorProfile;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PatientAppointmentController extends Controller
{
    public function index(User $user)
    {
        //Version 1
        /*$list = DB::table('users')
            //Join Appointments Table if Users ID = Appointments Patient User ID
            ->join('appointments', 'users.id', '=', 'appointments.patient_user_id')

            //Join DoctorProfiles Table if Appointments DoctorID = DoctorProfiles ID
            ->join('doctor_profiles', 'appointments.doctor_id', '=', 'doctor_profiles.id')

            //Display Doctor Name
            //->join('users', 'doctor_profiles.user_id', '=', 'users.id')


            //Where Appointments Patient User ID should be equal to Current User's ID
            ->where('appointments.patient_user_id', '=', Auth::user()->id)

            //Where Appointments Status is Pending
            ->where('appointments.status', '=', 'Pending')

            ->select('*', 'users.id as user_id')
            //->select('*', 'users.name as doctor_name')
            ->select('*', 'doctor_profiles.id as doctor_id')

            ->get();
        return view('patientappointment.index', compact('user'))->with('list', $list);*/

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

            ->select('*', 'users.id as doctor_user_id')
            ->orderBy("date", "ASC")

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
        $appointment = Appointment::findOrFail($id);
        return view('patientappointment.edit', compact('appointment'));
    }

    public function update(Request $request, $id)
    {
        $updateData = request()->validate([
            'date'=>'after:today',
        ]);

        Appointment::whereId($id)->update($updateData);
        return redirect('/patientappointment/pending')->with('Completed', 'Appointment details successfully updated.');
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

        if($existingAppointment)
        {
            return redirect('/patientappointment/linked')->with('Error', 'You have an upcoming appointment with the Doctor. Cannot set Link Status to Inactive.');
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
        $doctorProfile = DoctorProfile::findOrFail($id);
        return view('patientappointment.doctorprofile', compact('doctorProfile'));
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
            ->simplePaginate(5);
        return view ('patientappointment.search')->with('doc', $doc);
    }

    public function book($id)
    {
        $doctorProfile = DoctorProfile::findOrFail($id);
        $oneMonthFromNow = Carbon::now()->addDays(30);

        $list = DB::table('appointments')
            ->join('users', 'appointments.doctor_user_id', '=', 'users.id')
            ->join('doctor_profiles', 'appointments.doctor_id', '=', 'doctor_profiles.id')
            ->where('appointments.doctor_user_id', '=', $doctorProfile->user->id)
            ->where('appointments.status', '=', 'Accepted')
            ->whereDate('appointments.date', '<', $oneMonthFromNow)
            ->select('*', 'users.id as doctor_user_id')
            ->orderBy('appointments.date', 'ASC')
            ->get();
        return view('patientappointment.book', compact('doctorProfile'))->with('list', $list);
    }

    public function store(Request $request)
    {
        $doctorDateUnavailable = Appointment::where('doctor_id', $request->doctor_id)
            ->where('status', '=', 'Accepted')
            ->where('date', '=', $request->date)->exists();

        $patientDateUnavailable = Appointment::where('patient_id', $request->patient_id)
            ->where('status', '=', 'Accepted')
            ->where('date', '=', $request->date)->exists();

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
            $storeData = $request->validate([
                'patient_user_id' => 'required',
                'patient_id' => 'required',
                'patient_email' => 'required',
                'doctor_user_id' => 'required',
                'doctor_id' => 'required',
                'doctor_email' => 'required',
                'date' => 'required|after:7 days',
                'status' => 'required',
            ]);

            $appointment = Appointment::create($storeData);
            return redirect('patientappointment/list')->with('Completed', 'Appointment requested successfully. Please wait for the chosen doctor to accept.');
        }
    }
}
