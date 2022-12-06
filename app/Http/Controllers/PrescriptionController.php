<?php

namespace App\Http\Controllers;
use App\Models\Prescription;
use App\Models\User;
use App\Models\DoctorProfile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Dompdf\Dompdf;

class PrescriptionController extends Controller
{
    public function index()
    {
        $patients = DB::table('doctor_patient')
            ->join('users', 'doctor_patient.patient_user_id', '=', 'users.id')
            ->where('doctor_user_id', '=', Auth::user()->id)
            ->get();

        return view ('prescription')->with('patients', $patients);
    }

    public function save(Request $request){

        $this->validate($request, [
            'doctor_user_id' => 'required',
            'patient_user_id' => 'required',
            'name' => 'required',
            'date' => 'required|date',
            'prescription' => 'required'
        ]);

        $prescription = new Prescription();

        $prescription->doctor_user_id = $request->doctor_user_id;
        $prescription->patient_user_id = $request->patient_user_id;
        $prescription->name = $request->name;
        $prescription->date = $request->date;
        $prescription->prescription = $request->prescription;

        $prescription->save();

        DB::table('system_audit_trail')
            ->insert([
                'user_id' => Auth::user()->id,
                'action' => 'Create Prescription for Patient ID: '.$request->patient_id,
                'created_at' => Carbon::now()
            ]);

        return back()->with('success', 'Prescription has been saved!');
    }
}
