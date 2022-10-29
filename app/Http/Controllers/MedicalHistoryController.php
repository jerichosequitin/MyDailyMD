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

        //$mh = DB::select('SELECT * from medical_histories WHERE user_id ='.$user->id);
        //return view ('patientmedicalhistory')->with('mh', $mh);

        //$this->authorize('view', $user->medical_histories);
        //return view('patientmedicalhistory', compact('user'));
    }

    public function create()
    {
        //$this->authorize('update', $user->medical_histories);
        return view('patientmedicalhistory.create');
    }

    public function store(Request $request)
    {
        $storeData = $request->validate([
            'user_id' => 'required',
            'surgicalProcedure'=>'required',
            'hospital'=>'required',
            'surgeryDate'=>'required',
            'surgeryNotes'=>'required',
        ]);

        $medicalHistory = MedicalHistory::create($storeData);
        return redirect('/patientmedicalhistory')->with('Completed', 'Medical History successfully added');
    }

    public function edit($id)
    {
        $medicalHistory = MedicalHistory::findOrFail($id);
        return view('patientmedicalhistory.edit', compact('medicalHistory'));

        //$mh = DB::select('SELECT * from medical_histories WHERE id =1');
        //return view ('editpatientmedicalhistory')->with('mh', $mh);

        //$this->authorize('update', $user->medical_histories);
        //return view('editpatientmedicalhistory', compact('user'));
    }

    public function update(Request $request, $id)
    {
        //$this->authorize('update', $user->medical_histories);

        $updateData = request()->validate([
            'surgicalProcedure'=>'required',
            'hospital'=>'required',
            'surgeryDate'=>'required',
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
