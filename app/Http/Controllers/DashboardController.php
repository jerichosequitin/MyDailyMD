<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if(Auth::user()->hasRole('admin'))
        {
            return view('admindashboard');
        }
        elseif(Auth::user()->hasRole('doctor'))
        {
            $doctorPending = Appointment::where('doctor_user_id', Auth::user()->id)
                ->where('status', '=', 'Accepted')
                ->where('appointments.date', '=', now()->toDateString())
                ->get();

            $doctorPendingCount = count($doctorPending);

            return view('doctordashboard')->with('doctorPendingCount', $doctorPendingCount);
        }
        else
        {
            $patientPending = Appointment::where('patient_user_id', Auth::user()->id)
                ->where('status', '=', 'Accepted')
                ->where('appointments.date', '=', now()->toDateString())
                ->get();

            $patientPendingCount = count($patientPending);

            return view('patientdashboard')->with('patientPendingCount', $patientPendingCount);;
        }
    }
}
