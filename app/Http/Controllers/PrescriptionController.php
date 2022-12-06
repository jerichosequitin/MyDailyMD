<?php

namespace App\Http\Controllers;
use App\Models\Prescription;
use App\Models\User;
use App\Models\DoctorProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Dompdf\Dompdf;

class PrescriptionController extends Controller
{
    public function index()
    {
        return view ('prescription');
    }

    public function save(Request $request){

        $this->validate($request, [
            'user_id' => 'required',
            'name' => 'required',
            'date' => 'required|date',
            'prescription' => 'required'
        ]);

        $prescription = new Prescription();

        $prescription->user_id = $request->user_id;
        $prescription->name = $request->name;
        $prescription->date = $request->date;
        $prescription->prescription = $request->prescription;

        $prescription->save();

        return back()->with('success', 'Prescription has been saved!');
    }
}
