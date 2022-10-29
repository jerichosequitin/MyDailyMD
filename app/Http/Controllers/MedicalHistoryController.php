<?php

namespace App\Http\Controllers;

use App\Models\MedicalHistory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MedicalHistoryController extends Controller
{
    public function index()
    {
        $medicalHistory = MedicalHistory::where('user_id','=',Auth::user()->id)->get();
        return view('patientmedicalhistory.index', compact ('medicalHistory'));
    }

    public function create()
    {
        return view('patientmedicalhistory.create');
    }

    public function store(Request $request)
    {
        $storeData = $request->validate([
            'user_id' => 'required',
            'surgicalProcedure'=>'required',
            'hospital'=>'required',
            'surgeryDate'=>'required|before:today',
            'surgeryNotes'=>'required',
        ]);

        $medicalHistory = MedicalHistory::create($storeData);
        return redirect('/patientmedicalhistory')->with('Completed', 'Medical History successfully added');
    }

    public function edit($id)
    {
        $medicalHistory = MedicalHistory::findOrFail($id);

        $this->authorize('update', $medicalHistory);
        return view('patientmedicalhistory.edit', compact('medicalHistory'));
    }

    public function update(Request $request, $id)
    {
        $updateData = request()->validate([
            'surgicalProcedure'=>'required',
            'hospital'=>'required',
            'surgeryDate'=>'required|before:today',
            'surgeryNotes'=>'required',
        ]);

        MedicalHistory::whereId($id)->update($updateData);
        return redirect("/patientmedicalhistory")->with('Completed', 'Medical History successfully updated');
    }

    public function destroy($id)
    {
        $medicalHistory = MedicalHistory::findOrFail($id);
        $medicalHistory->delete();
        return redirect("/patientmedicalhistory")->with('Completed', 'Medical History successfully deleted');
    }
}
