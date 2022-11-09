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
        $medicalHistory = MedicalHistory::where('user_id','=',Auth::user()->id)
            ->where('status', '=', 'Active')
            ->simplePaginate(3);
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
            'status' => 'required',
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
        request()->validate([
            'surgicalProcedure'=>'required',
            'hospital'=>'required',
            'surgeryDate'=>'required|before:today',
            'surgeryNotes'=>'required',
        ]);

        $medicalHistory = MedicalHistory::findOrFail($id);
        $medicalHistory->surgicalProcedure = $request->surgicalProcedure;
        $medicalHistory->hospital = $request->hospital;
        $medicalHistory->surgeryDate = $request->surgeryDate;
        $medicalHistory->surgeryNotes = $request->surgeryNotes;
        $medicalHistory->save();
        return redirect("/patientmedicalhistory")->with('Completed', 'Medical History successfully updated');
    }

    public function view($id)
    {
        $medicalHistory= MedicalHistory::findOrFail($id);

        $this->authorize('update', $medicalHistory);
        return view('patientmedicalhistory.view', compact('medicalHistory'));
    }

    public function archive(Request $request, $id)
    {
        $archiveData = $request->validate([
            'status' => 'required',
        ]);

        MedicalHistory::whereId($id)->update($archiveData);
        return redirect("/patientmedicalhistory")->with('Completed', 'Medical History successfully deleted');
    }
}
