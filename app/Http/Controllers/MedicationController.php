<?php

namespace App\Http\Controllers;

use App\Models\Medication;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MedicationController extends Controller
{
    public function index()
    {
        $medication = Medication::where('user_id','=',Auth::user()->id)
            ->where('status', '=', 'Active')
            ->simplePaginate(3);
        return view('patientmedication.index', compact ('medication'));
    }

    public function prescriptionHistory()
    {
        $prescription = DB::table('prescriptions')
            ->join('users', 'prescriptions.doctor_user_id', '=', 'users.id')
            ->where('patient_user_id', '=', Auth::user()->id)
            ->simplePaginate(3);

        return view ('patientmedication.prescriptionhistory')->with('prescription', $prescription);
    }
}
